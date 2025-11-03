<?php

namespace App\Pipelines\Order;

use App\Models\Module;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\User;
use App\Traits\HasPayload;
use Illuminate\Support\Collection;

class OrderDTO
{
    use HasPayload;
    
    private null|Order $order;
    private null|User  $user;
    private Collection $orderItems;
    
    public function __construct(array $payload, Order $order)
    {
        $this->payload = $payload;
        $this->order = $order;
        $this->user = $this->order->user ?? auth()->user();
        $this->orderItems = collect();
    }
    
    public function getOrder(): Order
    {
        return $this->order;
    }
    
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }
    
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
    
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }
    
    public function setOrderItems(Collection $orderItems): void
    {
        $this->orderItems = $orderItems;
    }
    
    public function addOrderItem(array $orderItem): void
    {
        $this->orderItems->push($orderItem);
    }
    
    public function getPurchasedServices(): Collection
    {
        return collect($this->getFromPayload('order_items', []))->where('orderable_type', Service::class);
    }
    
    public function getPurchasedModules(): Collection
    {
        return collect($this->getFromPayload('order_items', []))->where('orderable_type', Module::class);
    }
    
}