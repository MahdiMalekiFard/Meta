<?php

namespace App\Repositories\Country;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Country;

interface CountryRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Country;
}
