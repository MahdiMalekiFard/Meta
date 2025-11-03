<?php

namespace App\Enums;

enum PlanMonthEnum: int
{
    use EnumToArray;
    
    case MONTH1  = 1;
    case MONTH3  = 3;
    case MONTH6  = 6;
    case MONTH12 = 12;
    
    public function title(): string
    {
        return match ($this->value) {
            self::MONTH1->value  => "1",
            self::MONTH3->value  => "3",
            self::MONTH6->value  => "6",
            self::MONTH12->value => "12",
        };
    }
}
