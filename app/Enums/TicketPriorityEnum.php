<?php

namespace App\Enums;

use App\Helpers\Constants;

enum TicketPriorityEnum: string
{
    use EnumToArray;
    
    case LOW    = "low";
    case NORMAL = "normal";
    case HIGH   = "high";
    
    public function title(): string
    {
        return match ($this) {
            self::LOW => __("ticket.low"),
            self::NORMAL => __("ticket.normal"),
            self::HIGH => __("ticket.high"),
            
        };
    }
    
    
    public function converted():array
    {
        return match ($this) {
            self::LOW => [
                'value' => self::LOW,
                'label' => __("ticket.low"),
                'color' => Constants::GREEN_COLOR
            ],
            self::NORMAL => [
                'value' => self::NORMAL,
                'label' => __("ticket.normal"),
                'color' => Constants::ORANGE_COLOR
            ],
            self::HIGH => [
                'value' => self::HIGH,
                'label' => __("ticket.high"),
                'color' => Constants::RED_COLOR
            ],
        };
    }
    
    public static function toArray(): array
    {
        return [
            [
                'value' => self::LOW,
                'label' => __("ticket.low"),
            ],
            [
                'value' => self::NORMAL,
                'label' => __("ticket.normal"),
            ],
            [
                'value' => self::HIGH,
                'label' => __("ticket.high"),
            ],
        ];
    }
}
