<?php

namespace App\Enums;

use App\Helpers\Constants;

enum TicketStatusEnum : string
{
    use EnumToArray;
    
    case OPEN = "open";
    case CLOSE = "close";
    
    
    public function title(): string
    {
        return match ($this) {
            self::OPEN => __("ticket.open"),
            self::CLOSE => __("ticket.close"),
        };
    }
    
    public function converted():array
    {
        return match ($this) {
            self::OPEN => [
                'value' => self::OPEN,
                'label' => __("ticket.open"),
                'color' => Constants::GREEN_COLOR
            ],
            self::CLOSE => [
                'value' => self::CLOSE,
                'label' => __("ticket.close"),
                'color' => Constants::RED_COLOR
            ],
        };
    }
    
    
    public static function toArray(): array
    {
        return [
            [
                'value' => self::OPEN,
                'label' => __("ticket.open"),
            ],
            [
                'value' => self::CLOSE,
                'label' => __("ticket.close"),
            ],
        ];
    }
}
