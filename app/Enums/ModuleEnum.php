<?php

namespace App\Enums;

enum ModuleEnum: string
{
    use EnumToArray;
    
    case Module1 = 'key1';
    case Module2 = 'key2';
    case Module3 = 'key3';
    case Module4 = 'key4';
    
    public function limitable(): bool
    {
        return match ($this->value) {
            self::Module1->value => true,
            self::Module2->value => true,
            default              => false,
        };
    }
    
    public
    function title(): string
    {
        return match ($this->value) {
            self::Module1->value => "گزارشات پایه",
            self::Module2->value => "گزارشات پیشرفته",
            self::Module3->value => "چت آنلاین",
            self::Module4->value => "اتصال به درگاه",
        };
    }
}
