<?php

namespace App\Actions\Plan;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Plan;
use App\Models\Service;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePlanAction
{
    use AsAction;
    
    public function __construct(private readonly PlanRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): Plan
    {
        return DB::transaction(function () use ($payload) {
            $data = [
                'planable_id'   => $payload['service_id'],
                'planable_type' => Service::class,
            ];
            
            $model = $this->repository->store($data);
            $pricings = [];
            /** @var array{month:int,plans:array{playType:array{price:int,price_special:int}}} $item */
            foreach (Arr::get($payload, 'prices', []) as $item) {
                foreach (Arr::get($item, 'plans') as $planType => $price) {
                    $pricings[] = [
                        'plan_id'  => $model->id,
                        'month'    => $item['month'],
                        'price'    => $price['price'],
                        'price_special' => $price['price_special'],
                        'type'     => $planType,
                    ];
                }
            }
            $model->pricings()->createMany($pricings);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
