<?php

namespace App\Enums;

enum OpinionPartEnum: string
{
    use EnumToArray;
    
    case RENT = "rent";
    case SALE = "sale";
    
    public function title(): string
    {
        return match ($this->value) {
            self::RENT->value => "Rent",
            self::SALE->value => "Sale",
        };
    }
}
