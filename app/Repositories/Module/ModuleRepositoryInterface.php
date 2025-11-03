<?php

namespace App\Repositories\Module;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Repositories\BaseRepositoryInterface;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

interface ModuleRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Module;
    
    public function getModulesByServiceAndTypeAndMonth(int $serviceId,PlanTypeEnum $type,PlanMonthEnum $month): Collection|array;
}
