<?php

namespace App\Services\Notify;

use App\Services\Notify\Contracts\EmailDriverInterface;
use App\Services\Notify\Contracts\SmsDriverInterface;
use App\Services\Notify\DTO\Message;
use App\Services\Notify\Support\Phone;
use App\Services\Notify\Template\TemplateRegistry;
use InvalidArgumentException;

class Notifier
{
    public function __construct(
        private TemplateRegistry $templates,
        private SmsDriverInterface $smsDriver,
        private EmailDriverInterface $emailDriver,
    )
    {
    }
    
    public function send(Message $msg): bool
    {
        $channel = $msg->channel ?: $this->templates->channel($msg->templateKey);
        $data = $this->templates->validatePayload($msg->templateKey, $msg->data);
        
        if ($channel === 'sms') {
            $to = Phone::normalize($msg->to);
            $providerTpl = $this->templates->providerTemplateName($msg->templateKey, $this->smsDriver->name());
            if (!$providerTpl) {
                throw new InvalidArgumentException("No provider template mapping for '{$msg->templateKey}' → " . $this->smsDriver->name());
            }
            // Order tokens according to config → convert to array
            $specs = config('notify_templates.' . $msg->templateKey . '.tokens', []);
            $tokens = array_map(function ($spec) use ($data) {
                return $data[$spec['name']] ?? null;
            }, $specs);
            return $this->smsDriver->sendTemplate($to, $providerTpl, $tokens);
        }
        
        if ($channel === 'email') {
            $info = $this->templates->mailableInfo($msg->templateKey);
            $mailable = $info['mailable'] ?? null;
            $subject = $info['subject'] ?? null;
            if (!$mailable) {
                throw new InvalidArgumentException("Mailable not defined for template '{$msg->templateKey}'.");
            }
            return $this->emailDriver->sendMailable($msg->to, $mailable, $data, $subject);
        }
        
        // notification push: add later
        throw new InvalidArgumentException("Unsupported channel '{$channel}'.");
    }
}
