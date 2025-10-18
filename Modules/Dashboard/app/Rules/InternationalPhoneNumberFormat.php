<?php

namespace Modules\Dashboard\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InternationalPhoneNumberFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isNotMatch = ! preg_match(
            '/^(\+?\d{1,3}[\s-]?)?\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}(\s*(ext|x|ext.)\s*\d{2,5})?$/i',
            $value
        );

        if ($isNotMatch) {
            $fail(__('dashboard::validation.phone_number'));
        }
    }
}
