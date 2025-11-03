<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use App\Enums\TableUserMetaFieldKeyEnum;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UserDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
//        $extra_filters = collect($values)->whereNotIn('column', $this->fillable_columns);
//        foreach ($extra_filters as $item) {
//
//        }
        return $query;
    }
}
