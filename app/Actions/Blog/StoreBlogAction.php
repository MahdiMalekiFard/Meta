<?php

namespace App\Actions\Blog;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBlogAction
{
    use AsAction;
    
    public function __construct(private readonly BlogRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): Blog
    {
        return DB::transaction(function () use ($payload) {
            /** @var Blog $model */
            
            $payload['user_id'] = auth()->id();
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            $model->categories()->sync(Arr::get($payload, 'categories_id',[]));
            $model->tags()->sync(Arr::get($payload, 'tags_id', []));
            if (request()?->hasFile('image')) {
                $model->addMediaFromRequest('image')->toMediaCollection('image');
            }
            return $model;
        });
    }
}
