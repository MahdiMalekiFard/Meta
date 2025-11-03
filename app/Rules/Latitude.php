<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Latitude implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression pattern for a valid latitude:
        $pattern = '/^[-]?([0-8]?[0-9]\.\d+)|90(\.0+)?$/';
        
        // Match the value against the pattern:
        if (preg_match($pattern, $value) !== 1) {
            $fail('validation.latitude')->translate(['attribute' => $attribute]);
        }
        
    }
    
}
