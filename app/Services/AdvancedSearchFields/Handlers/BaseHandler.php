<?php

namespace App\Services\AdvancedSearchFields\Handlers;

abstract class BaseHandler
{
    const INPUT  = "input";
    const DATE   = "date";
    const SELECT = "select";
    const NUMBER = "number";

    public abstract function handle(): array;

    public function add(string $key, string $label, string $type, array $options = []): array
    {
        return [
                "key"   => $key,
                "label" => $label,
                "type"  => $type,
            ] + (count($options) ? ["options" => $options] : []);
    }

    public function option(string $value, string $label): array
    {
        return compact('value', 'label');
    }

}
