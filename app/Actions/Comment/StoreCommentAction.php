<?php

namespace App\Actions\Comment;

use App\Helpers\Utils;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCommentAction
{
    use AsAction;

    public function __construct(private readonly CommentRepositoryInterface $repository)
    {
    }
    
    /**
     * @param array{
     *     parent_id:int,
     *     commentable_id:int,
     *     commentable_type:string,
     *     comment:string,
     *     type:string} $payload
     *
     * @return Comment
     */
    public function handle(array $payload): Comment
    {
        return DB::transaction(function () use ($payload) {
            $payload['user_id'] = auth()->id();
            if (!Arr::has($payload,'commentable_type')){
                $payload['commentable_type'] = Utils::getEloquent($payload['type']);
            }
            return $this->repository->store($payload);
        });
    }
}
