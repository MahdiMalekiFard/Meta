<?php

namespace App\Repositories\Plan;

use App\Enums\PlanTypeEnum;
use App\Repositories\BaseRepositoryInterface;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

interface PlanRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Plan;
    
    public function getPlansByService(array $serviceIds): Collection;
    
    public function getPlanByService(int $serviceId): Plan|null;
}
