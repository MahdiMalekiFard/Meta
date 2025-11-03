<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BootingSystemMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    private string $serverUrl;
    
    /**
     * Create a new message instance.
     */
    public function __construct(public readonly User $user)
    {
        $this->user->server->domain_name;
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), __('core.app_name')),
            subject: 'تحویل سرویس',
        );
    }
    
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.send-booting-system-mail',
            with: ['username' => '9100000000', 'password' => 'secret', 'website_url' => 'https://' . $this->user->server->domain_name . '-panel.weton.biz']
        );
    }
    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
