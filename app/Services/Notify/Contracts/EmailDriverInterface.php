<?php

namespace App\Services\Notify\Contracts;

interface EmailDriverInterface extends DriverInterface
{
    /**
     * Sending emails with Mailable class and input data
     */
    public function sendMailable(string $to, string $mailableClass, array $data, ?string $subject = null): bool;
}
