<?php

namespace App\Enums;

use App\Helpers\Constants;

enum TicketDepartmentEnum: string
{
    use EnumToArray;
    
    case CONTACT = "contact";
    case SELL    = "sell";
    
    public function title(): string
    {
        return match ($this) {
            self::CONTACT => __("ticket.contact"),
            self::SELL    => __("ticket.sell"),
        };
    }
    
    
    public function converted():array
    {
        return match ($this) {
            self::CONTACT => [
                'value' => self::CONTACT,
                'label' => __("ticket.contact"),
                'color' => Constants::GREEN_COLOR
            ],
            self::SELL => [
                'value' => self::SELL,
                'label' => __("ticket.sell"),
                'color' => Constants::RED_COLOR
            ],
        };
    }
    
    public static function toArray(): array
    {
        return [
            [
                'value' => self::CONTACT,
                'label' => __("ticket.contact"),
            ],
            [
                'value' => self::SELL,
                'label' => __("ticket.sell"),
            ],
        ];
    }
    
}
