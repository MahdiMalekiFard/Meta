<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleCommentAction
{
    use AsAction;

    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }

    public function handle(Comment $comment): Comment
    {
        return DB::transaction(function () use ($comment) {
            return $this->repository->toggle($comment);
        });
    }
}
