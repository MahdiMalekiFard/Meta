<?php

namespace App\Enums;

enum TicketActionTypeEnum: string
{
    use EnumToArray;
    
    case SERVICE         = "service";         // خدماتی
    case BUSINESS        = "business";        // بازرگانی
    case PRODUCTION      = "production";      // تولیدی
    case MEDICAL         = "medical";         // پزشکی
    case ONLINE_STORE    = "online_store";    // فروشگاه آنلاین
    case IN_PERSON_STORE = "in_person_store"; // فروشگاه حضوری
    case OTHER           = "other";           // سایر
    
    public function title(): string
    {
        return match ($this) {
            self::SERVICE         => __("ticket.action.service"),
            self::BUSINESS        => __("ticket.action.business"),
            self::PRODUCTION      => __("ticket.action.production"),
            self::MEDICAL         => __("ticket.action.medical"),
            self::ONLINE_STORE    => __("ticket.action.online_store"),
            self::IN_PERSON_STORE => __("ticket.action.in_person_store"),
            self::OTHER           => __("ticket.action.other"),
        };
    }
    
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->title(),
        ];
    }
    
}
