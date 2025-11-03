<?php

namespace App\Actions\PlanPricing;

use App\Enums\PermissionEnum;
use App\Models\PlanPricing;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePlanPricingAction
{
    use AsAction;

    public function __construct(private readonly PlanPricingRepositoryInterface $repository)
    {
    }


    /**
     * @param PlanPricing                                          $planPricing
     * @param array{name:string,mobile:string,email:string} $payload
     * @return PlanPricing
     */
    public function handle(PlanPricing $planPricing, array $payload): PlanPricing
    {
        return DB::transaction(function () use ($planPricing, $payload) {
            $planPricing->update($payload);
            return $planPricing;
        });
    }
}
