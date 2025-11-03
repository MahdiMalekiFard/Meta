<?php

namespace App\Repositories\Subscription;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Subscription;

interface SubscriptionRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Subscription;
}
