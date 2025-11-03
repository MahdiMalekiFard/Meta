<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Log;

trait GeneralFactoryFunctionsTrait
{
    
    public function addTitleToRequest($string = null): void
    {
        request()?->merge([
            'translation' => [
                app()->getLocale() => [
                   [
                       'key'   => 'title',
                       'value' => $string ?? fake()->sentence,
                   ]
                ],
            ],
        ]);
        Log::info("request: ",request()->all());
    }
    
    public function slugToText($string): string
    {
        return ucwords(str_replace('-', ' ', $string));
    }
}