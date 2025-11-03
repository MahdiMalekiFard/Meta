<?php

namespace App\Enums;

enum CategoryTypeEnum: string
{
    use EnumToArray;
    case ESTATE = "estate";
    case BLOG   = "blog";
    case SERVICE   = "service";
    case NOTICE   = "notice";
    case FAQ   = "faq";
    
    case REPORT   = "report";
}
