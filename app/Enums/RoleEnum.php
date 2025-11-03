<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: string
{
    use EnumToArray;
    
    case DEVELOPER = 'developer';
    case ADMIN     = 'admin';
    case AGENT     = 'agent';
    
}
