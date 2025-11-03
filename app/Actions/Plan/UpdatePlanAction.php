<?php

namespace App\Actions\Plan;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Plan;
use App\Models\Service;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePlanAction
{
    use AsAction;
    
    public function __construct(private readonly PlanRepositoryInterface $repository)
    {
    }
    
    /**
     * @param Plan                                          $plan
     * @param array{name:string,mobile:string,email:string} $payload
     *
     * @return Plan
     */
    public function handle(Plan $plan, array $payload): Plan
    {
        return DB::transaction(function () use ($plan, $payload) {
            $data = [
                'planable_id'   => $payload['service_id'],
                'planable_type' => Service::class,
            ];
            
            $plan->update($data);
            $pricings = [];
            /** @var array{month:int,plans:array{playType:array{price:int,price_special:int}}} $item */
            foreach (Arr::get($payload, 'prices', []) as $item) {
                foreach (Arr::get($item, 'plans') as $planType => $price) {
                    $pricings[] = [
                        'plan_id'  => $plan->id,
                        'month'    => $item['month'],
                        'price'    => $price['price'],
                        'price_special' => $price['price_special'],
                        'type'     => $planType,
                    ];
                }
            }
            foreach ($pricings as $pricing) {
                $plan->pricings()->updateOrCreate(
                    ['plan_id' => $plan->id, 'month' => $pricing['month'], 'type' => $pricing['type']],
                    ['price' => $pricing['price'], 'price_special' => $pricing['price_special']]);
            }
            SyncTranslationAction::run($plan);
            
            return $plan;
        });
    }
}
