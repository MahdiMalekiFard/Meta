<?php

namespace App\Listeners;

use App\Events\StoreTicketEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class StoreTicketListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Handle the event.
     */
    public function handle(StoreTicketEvent $event): void
    {
        if (Arr::get($event->payload, 'new_user', false) && config('app.debug') === false) {
            Http::withHeaders([
                'Accept' => 'application/json',
            ])->post(config('config.CRM_URL') . '/user/add-crm-user', [
                'mobile'      => $event->ticket->user->mobile,
                'name'        => $event->ticket->user->name ?? "Metanext User Name",
                'family'      => $event->ticket->user->family ?? "Metanext User Family",
                'company'     => $event->ticket->subject,
                'description' => $event->ticket->description,
            ]);
        }
    }
}
