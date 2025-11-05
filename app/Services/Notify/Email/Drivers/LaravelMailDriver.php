<?php

namespace App\Services\Notify\Email\Drivers;

use App\Services\Notify\Contracts\EmailDriverInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class LaravelMailDriver implements EmailDriverInterface
{
    public function name(): string
    {
        return 'laravel_mail';
    }
    
    public function sendMailable(string $to, string $mailableClass, array $data, ?string $subject = null): bool
    {
        try {
            $mailable = new $mailableClass($data, $subject);
            Mail::to($to)->send($mailable);
            return true;
        } catch (Throwable $e) {
            Log::error('Mail send error: ' . $e->getMessage(), compact('to', 'mailableClass'));
            return false;
        }
    }
}
