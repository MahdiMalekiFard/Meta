<?php

namespace App\Services\AdvancedSearchFields\Handlers;

class MessageHandler extends BaseHandler
{

    public function handle(): array
    {
        return [
            $this->add("id", __('validation.attributes.id'), self::NUMBER),
            $this->add("user_uuid", __('validation.attributes.user_uuid'), self::NUMBER),
            $this->add("message", __('validation.attributes.message'), self::INPUT),
        ];
    }
}
