<?php

namespace App\Actions\Like;

use App\Helpers\Utils;
use App\Models\Like;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreLikeAction
{
    use AsAction;
    
    public function __construct(private readonly LikeRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): Like|bool
    {
        return DB::transaction(function () use ($payload) {
            $like = Like::where('likeable_type', Utils::getEloquent(Arr::get($payload, 'type')))
                        ->where('likeable_id', Arr::get($payload, 'id'))
                        ->where('user_id', auth()->id())
                        ->first();
            $model = Utils::getEloquent(Arr::get($payload, 'type'))::find(Arr::get($payload, 'id'));
            if ($like) {
                $model->decrement('total_like');
                return $like->delete();
            }
            $model->increment('total_like');
            return $this->repository->store([
                'likeable_type' => Utils::getEloquent(Arr::get($payload, 'type')),
                'likeable_id'   => Arr::get($payload, 'id'),
                'user_id'       => auth()->id(),
            ]);
        });
    }
}
