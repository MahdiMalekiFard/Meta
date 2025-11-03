<?php

namespace App\Enums;

enum YesNoEnum: int
{
    case YES  = 1;
    case NO   = 0;
    
    public function title():string
    {
        return match ($this) {
            self::YES  => __('general.yes'),
            self::NO   => __('general.no')
        };
    }
}
