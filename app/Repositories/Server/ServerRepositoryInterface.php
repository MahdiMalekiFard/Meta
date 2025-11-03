<?php

namespace App\Repositories\Server;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Server;

interface ServerRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Server;
}
