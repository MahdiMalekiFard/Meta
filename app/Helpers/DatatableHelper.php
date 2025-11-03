<?php

namespace App\Helpers;

class DatatableHelper
{
    
    public static function published($status)
    {
        return $status->value ? __('datatable.published') : __('datatable.un_publish');
    }
    
}