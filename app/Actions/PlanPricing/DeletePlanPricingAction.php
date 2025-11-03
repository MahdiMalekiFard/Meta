<?php

namespace App\Actions\PlanPricing;

use App\Models\PlanPricing;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePlanPricingAction
{
    use AsAction;

    public function __construct(public readonly PlanPricingRepositoryInterface $repository)
    {
    }

    public function handle(PlanPricing $planPricing): bool
    {
        return DB::transaction(function () use ($planPricing) {
            return $this->repository->delete($planPricing);
        });
    }
}
