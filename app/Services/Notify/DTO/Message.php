<?php

namespace App\Services\Notify\DTO;

class Message
{
    public function __construct(
        public string $templateKey,     // Internal key like 'contact_admin_sms'
        public string $to,              // Recipient (number or email)
        public array $data = [],        // Required template data (tokens/fields)
        public ?string $channel = null  // 'sms' | 'email' — if null, we'll find out from the registry
    )
    {
    }
}
