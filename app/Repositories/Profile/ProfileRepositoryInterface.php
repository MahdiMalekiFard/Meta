<?php

namespace App\Repositories\Profile;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Profile;

interface ProfileRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Profile;
}
