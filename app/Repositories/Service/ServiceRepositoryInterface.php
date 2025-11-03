<?php

namespace App\Repositories\Service;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Service;
    public function related(Service $service): Collection;
}
