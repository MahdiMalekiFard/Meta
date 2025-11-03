<?php

namespace App\Pipelines\Order;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Models\Service;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use Closure;
use Illuminate\Support\Arr;

class SyncUserService implements OrderContract
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly PlanRepositoryInterface $planRepository,
        private readonly PlanPricingRepositoryInterface $planPricingRepository,
    )
    {
    }
    
    public function handle(OrderDTO $DTO, Closure $next)
    {
        
        $user = $DTO->getUser();
        
        foreach ($DTO->getPurchasedServices() as $purchaseService) {
            
            $service = $this->serviceRepository->find($purchaseService['orderable_id']);
            
            //3.1. Get service price with a certain type and month.
            $plan = $this->planRepository->getPlanByService($service->id); //just one plan for a service
            $planPricing = $this->planPricingRepository->getPricingByPlan($plan?->id, PlanTypeEnum::from($purchaseService['type']), PlanMonthEnum::from($purchaseService['month']));
           
            $DTO->addOrderItem([
                'orderable_type' => Service::class,
                'orderable_id'   => $service->id,
                'price'          => $planPricing->price_special ?? 0,
                'month'          => $purchaseService['month'],
                'type'           => $purchaseService['type'],
            ]);
            
            //3.1. Get modules from services for a certain type
            $user->services()->syncWithPivotValues($service->id, [
                'started_at' => now(),
                'expired_at' => now()->addMonths(Arr::get($purchaseService, 'month', 1)),
                'type'=> Arr::get($purchaseService, 'type', 1),
            ], false);
            
            //4. sync user modules from services with certain limit
//                $modules = $service->modules()->wherePivot('plan_type', $purchaseService['type'])->get();
//                foreach ($modules as $module) {
//                    $user->modules()->syncWithPivotValues($module->id, [
//                        'limit' => $module->pivot->limit,
//                    ], false);
//                }
        
        }
        
        return $next($DTO);
    }
}