<?php

namespace App\Actions\PlanPricing;

use App\Models\PlanPricing;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePlanPricingAction
{
    use AsAction;

    public function __construct(private readonly PlanPricingRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): PlanPricing
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
