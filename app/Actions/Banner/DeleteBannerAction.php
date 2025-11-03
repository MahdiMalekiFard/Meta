<?php

namespace App\Actions\Banner;

use App\Models\Banner;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBannerAction
{
    use AsAction;

    public function __construct(public readonly BannerRepositoryInterface $repository)
    {
    }

    public function handle(Banner $banner): bool
    {
        return DB::transaction(function () use ($banner) {
            return $this->repository->delete($banner);
        });
    }
}
