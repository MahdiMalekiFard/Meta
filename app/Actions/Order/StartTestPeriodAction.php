<?php

namespace App\Actions\Order;

use App\Enums\OrderStatusEnum;
use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Models\Order;
use App\Models\Service;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class StartTestPeriodAction
{
    use AsAction;
    
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly PlanRepositoryInterface $planRepository,
        private readonly PlanPricingRepositoryInterface $planPricingRepository,
        private readonly StoreOrderAction $storeOrderAction
    )
    {
    }
    
    /**
     * @throws Throwable
     */
    public function handle(array $payload = []): array
    {
        return DB::transaction(function () use ($payload) {
//            check if user has test period usage
            throw_if(auth()->user()->profile->test_period_usage, BadRequestException::class, 'شما قبلا از دوره تست خود استفاده کردید');
            
            //retreave all services like CRM SHOP ACCOUNTING HRM
            $services = $this->serviceRepository->get()->pluck('id')->toArray();
            
            $orderItems = [];
            foreach ($services as $serviceId) {
                $orderItems[] = [
                    'orderable_type' => Service::class,
                    'orderable_id'   => $serviceId,
                    'month'          => PlanMonthEnum::MONTH1->value,
                    'type'           => PlanTypeEnum::TYPE4->value,
                ];
            }
            
            $order = $this->storeOrderAction->handle(array_merge($payload,
                [
                    'user_id'        => auth()->id(),
                    'total_price'    => 0,
                    'note'           => 'Test period',
                    'status'         => OrderStatusEnum::PAID,
                    'paid_at'        => now(),
                    'paid_by'        => 1,
                    'payment_method' => null,
                    'repeatable'     => false,
                    'order_items'    => $orderItems,
                ]));
            
            // set discount equal to total price
            $order->update([
                'discount_price' => $order->total_price,
                'total_price'    => 0,
            ]);
            
            //update usage from test period for user profile
            auth()->user()->profile()->update([
                'test_period_usage' => true,
            ]);
            
            return [
                'discount_price' => $order->discount_price,
                'customer_name'  => Arr::get($payload, 'domain_name', '---'),
            ];
        });
    }
}
