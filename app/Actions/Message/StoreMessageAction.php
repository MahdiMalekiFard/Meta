<?php

namespace App\Actions\Message;

use App\Models\Message;
use App\Models\Ticket;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreMessageAction
{
    use AsAction;

    public function __construct(
        private readonly MessageRepositoryInterface $repository,
        private readonly FileService $fileService
    )
    {
    }

    public function handle(Ticket $ticket,array $payload): Message
    {
        return DB::transaction(function () use ($ticket,$payload) {
            $payload['user_id'] = auth('sanctum')->id();
            $payload['ticket_id'] = $ticket->id;
            $model = $this->repository->store($payload);
            $this->fileService->addMedia($model,'media','media');
         // todo event
            $ticket->touch();
            return $model;
            
        });
    }
}
