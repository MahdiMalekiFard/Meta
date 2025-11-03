<?php

namespace App\ExtraAttributes;

enum UserRequestExtraEnum: string
{
    case FIRST_NAME = 'first_name';
    case LAST_NAME  = 'last_name';
    case SUBJECT    = 'subject';
    case MESSAGE    = 'message';
    case PHONE      = 'phone';
    case EMAIL      = 'email';
    
}
