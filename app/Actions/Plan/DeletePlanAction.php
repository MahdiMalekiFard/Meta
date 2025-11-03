<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePlanAction
{
    use AsAction;

    public function __construct(public readonly PlanRepositoryInterface $repository)
    {
    }

    public function handle(Plan $plan): bool
    {
        return DB::transaction(function () use ($plan) {
            return $this->repository->delete($plan);
        });
    }
}
