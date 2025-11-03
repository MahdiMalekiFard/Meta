<?php

namespace App\Actions\Service;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreServiceAction
{
    use AsAction;
    
    public function __construct(
        private readonly ServiceRepositoryInterface $repository,
        private readonly FileService $fileService
    )
    {
    }
    
    public function handle(array $payload): Service
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            $this->fileService->addMedia($model);
            return $model;
        });
    }
}
