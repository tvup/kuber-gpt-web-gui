<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotNumeric implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(is_numeric($value)) {
            $fail('Value must not be numeric.');
        }
    }
}
