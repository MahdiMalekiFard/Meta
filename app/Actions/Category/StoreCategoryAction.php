<?php

namespace App\Actions\Category;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCategoryAction
{
    use AsAction;
    
    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
        private readonly FileService $fileService)
    {
    }

    public function handle(array $payload): Category
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            $model->categories()->sync([Arr::get($payload, 'parent_id')]);
            $this->fileService->addMedia($model);
            return $model;
        });
    }
}
