<?php

namespace App\Enums;

enum GenderEnum: int
{
    case MEN   = 1;
    case WOMEN = 0;
    
    public function title()
    {
        return match ($this) {
            self::MEN   => 'مرد',
            self::WOMEN => 'زن'
        };
    }
}
