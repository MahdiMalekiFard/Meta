<?php

namespace App\Enums;

enum EstatePurposeEnum: int
{
    case RENT = 1;
    case SALE = 2;
    
    public function title(): string
    {
        return match ($this) {
            self::RENT => __('core.rent'),
            self::SALE => __('core.sale'),
        };
    }
}
