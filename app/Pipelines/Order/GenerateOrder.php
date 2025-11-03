<?php

namespace App\Pipelines\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use Closure;

class GenerateOrder implements OrderContract
{
    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
    }
    
    public function handle(OrderDTO $DTO, Closure $next)
    {
        
        $order = $this->orderRepository->store($DTO->getPayload());
        $DTO->setOrder($order);
        
        return $next($DTO);
    }
}