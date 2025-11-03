<?php

namespace App\Repositories\Banner;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Banner;

interface BannerRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Banner;
}
