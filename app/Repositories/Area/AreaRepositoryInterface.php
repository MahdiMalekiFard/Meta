<?php

namespace App\Repositories\Area;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Area;

interface AreaRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Area;
}
