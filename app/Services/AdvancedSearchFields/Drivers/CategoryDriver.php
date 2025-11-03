<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class CategoryDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
        $this->extraFilter($values)->each(function ($item) use ($query) {
            switch ($item['column']) {
            
            }
        });
       
        return $query;
    }
}
