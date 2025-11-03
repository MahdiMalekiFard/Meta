<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class ServiceDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
        $this->extraFilter($values)->each(function ($item) use ($query) {
            switch ($item['column']) {
                case "category_id":
                    $query->whereHas("categories", function ($q) use ($item) {
                        $this->addQuery($q, Arr::set($item, "column", "id"));
                    });
                    break;
            }
        });
       
        return $query;
    }
}
