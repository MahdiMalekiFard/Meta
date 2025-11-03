<?php

namespace App\Enums;

enum PropertyTypeEnum: string
{
    use EnumToArray;
    
    case NUMBER  = "number";
    case TEXT    = "text";
    case BOOLEAN = "boolean";
    
    public function title(): string
    {
        return trans('property.types.' . $this->value) ?? '---';
    }
}
