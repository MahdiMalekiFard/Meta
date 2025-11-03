<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreTicketEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public Ticket $ticket;
    public array  $payload;
    
    /**
     * Create a new event instance.
     *
     * @param Ticket                 $ticket
     * @param array{new_user:string} $payload
     */
    public function __construct(Ticket $ticket, array $payload)
    {
        $this->ticket = $ticket;
        $this->payload = $payload;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
