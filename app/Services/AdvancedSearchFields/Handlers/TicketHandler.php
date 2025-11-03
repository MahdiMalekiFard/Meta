<?php

namespace App\Services\AdvancedSearchFields\Handlers;

class TicketHandler extends BaseHandler
{

    public function handle(): array
    {
        return [
            $this->add("subject", __('validation.attributes.subject'), self::INPUT),
            $this->add("description", __('validation.attributes.description'), self::INPUT),
            $this->add("user_uuid", __('validation.attributes.user_uuid'), self::NUMBER),
        ];
    }
}
