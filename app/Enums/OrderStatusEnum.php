<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    use EnumToArray;
    
    case PENDING = 'pending';
    case PAID    = 'paid';
    case CANCEL  = 'cancel';
    case EXPIRED = 'expired';
    
    public function title(): string
    {
        return match ($this->value) {
            self::PENDING->value => "Pending",
            self::PAID->value    => "Paid",
            self::CANCEL->value  => "Cancel",
            self::EXPIRED->value => "Expired",
        };
    }
}
