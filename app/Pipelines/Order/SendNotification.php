<?php

namespace App\Pipelines\Order;

use App\Jobs\SendBootingSystemMailJob;
use App\Mail\BootingSystemMail;
use App\Mail\SendVerificationCodeMail;
use Closure;
use Illuminate\Support\Facades\Mail;

class SendNotification implements OrderContract
{
    
    public function handle(OrderDTO $DTO, Closure $next)
    {
        $user = $DTO->getUser();
        
        SendBootingSystemMailJob::dispatch($user)->delay(now()->addMinutes(10));
        
        return $next($DTO);
    }
}