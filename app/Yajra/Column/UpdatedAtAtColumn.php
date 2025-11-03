<?php

namespace App\Yajra\Column;

use App\Helpers\Constants;
use Illuminate\Support\Str;

class UpdatedAtAtColumn implements ColumnContract
{
    
    public function __invoke($row): string
    {
        return jdate($row->updated_at)->format(
            Constants::DEFAULT_DATE_FORMAT
        );
    }
}