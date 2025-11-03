<?php

namespace App\Actions\Ticket;

use App\Actions\Message\StoreMessageAction;
use App\Events\StoreTicketEvent;
use App\Models\Ticket;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTicketAction
{
    use AsAction;
    
    public function __construct(
        private readonly TicketRepositoryInterface $repository,
        private readonly MessageRepositoryInterface $messageRepository,
        private readonly StoreMessageAction $storeMessageAction,
        private readonly UserRepositoryInterface $userRepository,
        private readonly FileService $fileService
    )
    {
    }
    
    public function handle(array $payload): Ticket
    {
        return DB::transaction(function () use ($payload) {
            if (auth('sanctum')->check()) {
                $payload['user_id'] = auth('sanctum')->id();
            } else {
                $user = $this->userRepository->firstOrCreate([
                    'mobile' => Arr::get($payload, 'mobile'),
                ], [
                    'name'   => Arr::get($payload, 'name'),
                    'family' => Arr::get($payload, 'family'),
                ]);
                $payload['user_id'] = $user->id;
                Auth::login($user);
            }
            /** @var Ticket $model */
            $model = $this->repository->store($payload);
            $this->storeMessageAction->handle($model,[
                'user_id'   => $payload['user_id'],
                'ticket_id' => $model->id,
                'message'   => $payload['description'],
            ]);
            
            StoreTicketEvent::dispatch($model, ['new_user' => !auth()->check()]);
            
            return $model->fresh()?->load('lastMessage','lastMessage.media', 'user');
            
        });
    }
}
