<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use App\Enums\TableUserMetaFieldKeyEnum;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

class CommentDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
        $this->extraFilter($values)->each(function ($item) use ($query) {
            switch ($item['column']) {
                case "active":
                    $query = $query->active($item['from']);
                    break;
            }
        });
        return $query;
    }
}
