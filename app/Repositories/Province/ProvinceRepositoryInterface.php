<?php

namespace App\Repositories\Province;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Province;

interface ProvinceRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Province;
}
