<?php

namespace App\Actions\Message;

use App\Enums\PermissionEnum;
use App\Models\Message;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateMessageAction
{
    use AsAction;

    public function __construct(private readonly MessageRepositoryInterface $repository)
    {
    }


    /**
     * @param Message                                          $message
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Message
     */
    public function handle(Message $message, array $payload): Message
    {
        return DB::transaction(function () use ($message, $payload) {
            $message->update($payload);
            return $message;
        });
    }
}
