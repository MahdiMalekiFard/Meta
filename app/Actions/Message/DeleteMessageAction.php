<?php

namespace App\Actions\Message;

use App\Models\Message;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteMessageAction
{
    use AsAction;

    public function __construct(public readonly MessageRepositoryInterface $repository)
    {
    }

    public function handle(Message $message): bool
    {
        return DB::transaction(function () use ($message) {
            return $this->repository->delete($message);
        });
    }
}
