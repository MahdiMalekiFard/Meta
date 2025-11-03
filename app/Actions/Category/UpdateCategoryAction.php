<?php

namespace App\Actions\Category;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCategoryAction
{
    use AsAction;
    
    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
        private readonly FileService $fileService)
    {
    }
    
    /**
     * @param Category                                      $category
     * @param array{name:string,mobile:string,email:string} $payload
     *
     * @return Category
     */
    public function handle(Category $model, array $payload): Category
    {
        return DB::transaction(function () use ($model, $payload) {
            $model->update($payload);
            SyncTranslationAction::run($model);
            $model->categories()->sync([Arr::get($payload, 'parent_id')]);
            $this->fileService->addMedia($model);
            return $model;
        });
    }
}
