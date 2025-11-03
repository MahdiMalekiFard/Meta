<?php

namespace App\Pipelines\Order;

use App\Models\Module;
use App\Models\Service;
use Closure;
use Illuminate\Support\Arr;

class SyncUserModule implements OrderContract
{
    
    public function handle(OrderDTO $DTO, Closure $next)
    {
        $user = $DTO->getUser();
        foreach ($DTO->getPurchasedModules() as $purchaseModule) {
            $user->modules()->syncWithPivotValues($purchaseModule['orderable_id'], [
                'limit' => $purchaseModule['limit'],
            ], false);
            
            $DTO->addOrderItem([
                'orderable_type' => Module::class,
                'orderable_id'   => $purchaseModule['orderable_id'],
                'price'          => 0,
                'month'          => $purchaseModule['month'],
                'type'           => $purchaseModule['type'],
            ]);
        }
        
        return $next($DTO);
    }
}