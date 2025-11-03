<?php

namespace App\Pipelines\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Closure;

class GenerateOrderItem implements OrderContract
{
    public function __construct(
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly OrderRepositoryInterface $orderRepository
    )
    {
    }
    
    public function handle(OrderDTO $DTO, Closure $next)
    {
        $order = $DTO->getOrder();
        foreach ($DTO->getOrderItems() as $orderItem) {
            $orderItem['order_id'] = $order->id;
            $this->orderItemRepository->store($orderItem);
        }
        
        $this->orderRepository->update($order, [
            'total_price' => $order->items()->sum('price') - $order->discount_price,
        ]);
        
        return $next($DTO);
    }
}