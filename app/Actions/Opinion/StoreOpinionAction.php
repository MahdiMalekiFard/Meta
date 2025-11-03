<?php

namespace App\Actions\Opinion;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOpinionAction
{
    use AsAction;

    public function __construct(
        private readonly OpinionRepositoryInterface $repository,
        private readonly FileService $fileService)
    {
    }

    public function handle(array $payload): Opinion
    {
        return DB::transaction(function () use ($payload) {
            $payload['user_id']= auth()->id();
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            $this->fileService->addMedia($model);
            return $model;
        });
    }
}
