<?php

namespace App\Actions\Banner;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Banner;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBannerAction
{
    use AsAction;

    public function __construct(private readonly BannerRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Banner
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
