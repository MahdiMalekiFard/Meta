<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ActiveFilter implements Filter
{
    
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->active($value);
    }
}
