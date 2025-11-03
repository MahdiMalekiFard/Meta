<?php

namespace App\Actions\Banner;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Banner;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBannerAction
{
    use AsAction;

    public function __construct(private readonly BannerRepositoryInterface $repository)
    {
    }


    /**
     * @param Banner                                          $banner
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Banner
     */
    public function handle(Banner $banner, array $payload): Banner
    {
        return DB::transaction(function () use ($banner, $payload) {
            $banner->update($payload);
            SyncTranslationAction::run($banner);
            return $banner;
        });
    }
}
