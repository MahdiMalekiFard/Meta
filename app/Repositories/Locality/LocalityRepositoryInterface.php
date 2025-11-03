<?php

namespace App\Repositories\Locality;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Locality;

interface LocalityRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Locality;
}
