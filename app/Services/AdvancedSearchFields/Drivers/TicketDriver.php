<?php

namespace App\Services\AdvancedSearchFields\Drivers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class TicketDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
        return $query;
    }
}
