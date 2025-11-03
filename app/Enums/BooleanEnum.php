<?php

namespace App\Enums;

enum BooleanEnum: int
{
    case DISABLE = 0;
    case ENABLE  = 1;
    
    public function title(): string
    {
        return match ($this) {
            self::DISABLE => __('core.disable'),
            self::ENABLE => __('core.enable'),
        };
    }
}
