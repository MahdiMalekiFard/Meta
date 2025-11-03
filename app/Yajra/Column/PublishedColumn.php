<?php

namespace App\Yajra\Column;

use App\Helpers\DatatableHelper;
use Illuminate\Support\Str;

class PublishedColumn implements ColumnContract
{
    
    public function __invoke($row): string
    {
        return DatatableHelper::published($row->published);
    }
}