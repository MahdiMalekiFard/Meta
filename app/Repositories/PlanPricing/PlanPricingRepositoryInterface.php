<?php

namespace App\Repositories\PlanPricing;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Repositories\BaseRepositoryInterface;
use App\Models\PlanPricing;
use Illuminate\Database\Eloquent\Collection;

interface PlanPricingRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): PlanPricing;
    
    public function getPricingByPlan(int $planId, PlanTypeEnum $type,PlanMonthEnum $month):PlanPricing|null;
}
