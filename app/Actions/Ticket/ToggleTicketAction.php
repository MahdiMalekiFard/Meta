<?php

namespace App\Actions\Ticket;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleTicketAction
{
    use AsAction;
    
    public function __construct(private readonly TicketRepositoryInterface $repository)
    {
    }
    
    public function handle(Ticket $ticket): Ticket
    {
        return DB::transaction(function () use ($ticket) {
            if ($ticket->status === TicketStatusEnum::CLOSE) {
                $ticket->status = TicketStatusEnum::OPEN;
                $ticket->closed_by = null;
            } else {
                $ticket->status = TicketStatusEnum::CLOSE;
                $ticket->closed_by = auth()->id();
            }
            $ticket->save();
            
            return $ticket->fresh();
        });
    }
}
