<?php

namespace App\Services\Notify\Contracts;

interface SmsDriverInterface extends DriverInterface
{
    /**
     * Submit with VerifyLookup: Up to 3 tokens
     */
    public function sendTemplate(string $to, string $providerTemplate, array $tokens): bool;
    
    /**
     * Send plain text (fallback)
     */
    public function sendText(string $to, string $message): bool;
}
