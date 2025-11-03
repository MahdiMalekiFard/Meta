<?php

namespace App\Enums;

enum PlanTypeEnum: int
{
    use EnumToArray;
    
    case TYPE1 = 1;
    case TYPE2 = 2;
    case TYPE3 = 3;
    case TYPE4 = 4;
    public function title(): string
    {
        return match ($this->value) {
            self::TYPE1->value => "پایه",
            self::TYPE2->value => "استاندارد",
            self::TYPE3->value => "پیشرفته",
            self::TYPE4->value => "شرکتی",
        };
    }
    
    public function icon(): string
    {
        return match ($this->value) {
            self::TYPE1->value => config('app.url').'images/icon/plan-type/1.png',
            self::TYPE2->value => config('app.url').'images/icon/plan-type/2.png',
            self::TYPE3->value => config('app.url').'images/icon/plan-type/3.png',
            self::TYPE4->value => config('app.url').'images/icon/plan-type/4.png',
        };
    }
    
}
