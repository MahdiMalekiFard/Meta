<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression pattern for a valid latitude:
        $pattern = '/(0)[0-9]{9}/';
        
        // Match the value against the pattern:
        if (preg_match($pattern, $value) !== 1) {
            $fail('validation.mobile')->translate(['attribute' => $attribute]);
        }
    }
}
