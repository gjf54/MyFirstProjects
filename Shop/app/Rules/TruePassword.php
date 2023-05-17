<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TruePassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rexpr = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[-*+!]).{8,14}$/';

        if (!preg_match($rexpr, $value)) {
            $fail('Not strong password');
        }
    }
}
