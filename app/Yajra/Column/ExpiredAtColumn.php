<?php

namespace App\Yajra\Column;

use App\Helpers\Constants;
use Illuminate\Support\Str;

class ExpiredAtColumn implements ColumnContract
{
    
    public function __invoke($row): string
    {
        return jdate($row->expired_at)->format(
            Constants::DEFAULT_DATE_FORMAT
        );
    }
}