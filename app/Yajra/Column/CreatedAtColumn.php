<?php

namespace App\Yajra\Column;

use App\Helpers\Constants;
use Illuminate\Support\Str;

class CreatedAtColumn implements ColumnContract
{
    
    public function __invoke($row): string
    {
        return jdate($row->created_at)->format(
            Constants::DEFAULT_DATE_FORMAT
        );
    }
}