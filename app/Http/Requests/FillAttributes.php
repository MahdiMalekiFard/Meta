<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;

trait FillAttributes
{
    public function attributes(): array
    {
        return $this->generateAttributes();
    }

    public function generateAttributes(): array
    {
        return collect($this->rules())->filter(function ($item,$key) {
            return Str::contains($key, '.');
        })->map(function ($item,$key) {
            $key = "validation.attributes." . last(explode('.', $key));
            return trans($key);
        })->toArray();
    }
}
