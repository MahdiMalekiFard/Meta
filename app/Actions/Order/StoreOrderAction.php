<?php

namespace App\Actions\Order;

use App\Enums\OrderStatusEnum;
use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Models\Module;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Pipelines\Order\GenerateOrder;
use App\Pipelines\Order\GenerateOrderItem;
use App\Pipelines\Order\GenerateServer;
use App\Pipelines\Order\OrderDTO;
use App\Pipelines\Order\SendNotification;
use App\Pipelines\Order\SyncUserModule;
use App\Pipelines\Order\SyncUserService;
use App\Repositories\Module\ModuleRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreOrderAction
{
    use AsAction;
    
    public function __construct(
        private readonly OrderRepositoryInterface $repository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly ModuleRepositoryInterface $moduleRepository,
        private readonly PlanRepositoryInterface $planRepository,
        private readonly PlanPricingRepositoryInterface $planPricingRepository,
    )
    {
    }
    
    public function handle(array $payload): Order
    {
        return DB::transaction(function () use ($payload) {
            $DTO = new OrderDTO($payload, new Order([
                'user_id'        => Arr::get($payload, 'user_id', auth()->id()),
                'total_price'    => Arr::get($payload, 'total_price', 0),
                'discount_price' => Arr::get($payload, 'discount_price', 0),
                'note'           => Arr::get($payload, 'note', 'Test period'),
                'status'         => Arr::get($payload, 'status', OrderStatusEnum::PENDING),
                'repeatable'     => Arr::get($payload, 'repeatable', false),
            ]));
            
            return app(Pipeline::class)
                ->send($DTO)
                ->through([
                    GenerateOrder::class,
                    SyncUserService::class,
                    SyncUserModule::class,
                    GenerateOrderItem::class,
                    GenerateServer::class,
                    SendNotification::class
                ])
                ->then(function (OrderDTO $DTO) {
                    
                    return $DTO->getOrder()->fresh();
                });
        });
    }
}
