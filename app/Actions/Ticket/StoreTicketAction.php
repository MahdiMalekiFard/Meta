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
use Throwable;

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
    
    /**
     * @throws Throwable
     */
    public function handle(array $payload): Ticket
    {
        return DB::transaction(function () use ($payload) {
            if (auth('sanctum')->check()) {
                $payload['user_id'] = auth('sanctum')->id();
            } else {
                $completeName = trim(Arr::get($payload, 'complete_name', ''));
                
                // Split the name by space
                $parts = preg_split('/\s+/', $completeName, 2);
                
                $firstName = $parts[0] ?? null;
                $familyName = $parts[1] ?? null;
                
                $user = $this->userRepository->firstOrCreate(
                    ['mobile' => Arr::get($payload, 'mobile')],
                    [
                        'name'   => $firstName,
                        'family' => $familyName,
                    ]
                );
                
                $payload['user_id'] = $user->id;
                Auth::login($user);
            }
            
            $payload['subject'] = Arr::get($payload, 'subject') ?? '';
            
            /** @var Ticket $model */
            $model = $this->repository->store($payload);
            $this->storeMessageAction->handle($model, [
                'user_id'   => $payload['user_id'],
                'ticket_id' => $model->id,
                'message'   => $payload['description'],
            ]);
            
            StoreTicketEvent::dispatch($model, ['new_user' => !auth()->check()]);
            
            return $model->fresh()?->load('lastMessage', 'lastMessage.media', 'user');
            
        });
    }
}
