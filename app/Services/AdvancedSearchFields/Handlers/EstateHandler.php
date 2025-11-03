<?php

namespace App\Services\AdvancedSearchFields\Handlers;

use App\Enums\BooleanEnum;

class EstateHandler extends BaseHandler
{

    public function handle(): array
    {
        return [
            $this->add("id", __('validation.attributes.id'), self::NUMBER),
            $this->add("active", __('validation.attributes.published'), self::SELECT, [
                $this->option(BooleanEnum::DISABLE->value, BooleanEnum::DISABLE->title()),
                $this->option(BooleanEnum::ENABLE->value, BooleanEnum::ENABLE->title()),
            ]),
        ];
    }
}
