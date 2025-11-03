<?php

namespace App\Enums;

enum UserRequestTypeEnum: string
{
    case REPORT = 'contact';
    case OTHER  = 'other';
    
}
