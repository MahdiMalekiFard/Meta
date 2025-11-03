<?php

namespace App\Actions\Subscription;

use App\Models\Subscription;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreSubscriptionAction
{
    use AsAction;
    
    public function __construct(private readonly SubscriptionRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): ?Subscription
    {
        return DB::transaction(function () use ($payload) {
            if ($this->repository->find($payload['email'], 'email')) {
                abort(Response::HTTP_BAD_REQUEST, __('core.already_subscribed'));
            }
            return $this->repository->store($payload);
        });
    }
}
