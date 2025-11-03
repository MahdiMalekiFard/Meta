<?php

namespace App\Actions\Subscription;

use App\Models\Subscription;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteSubscriptionAction
{
    use AsAction;

    public function __construct(public readonly SubscriptionRepositoryInterface $repository)
    {
    }

    public function handle(Subscription $subscription): bool
    {
        return DB::transaction(function () use ($subscription) {
            return $this->repository->delete($subscription);
        });
    }
}
