<?php

namespace App\Pipelines\Order;

use Closure;

interface OrderContract
{
    public function handle(OrderDTO $DTO, Closure $next);
}