<?php

namespace Modules\Dashboard\Rules;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\ValidationRule;

class MatchOldPassword implements ValidationRule
{
    private string $guard;

    public function __construct(string $guard = 'admin')
    {
        $this->guard = $guard;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isNotMatch = ! Hash::check(request()->current_password, auth($this->guard)->user()->password);

        if ($isNotMatch) {
            $fail(__('dashboard::dashboard.current_password_not_match'));
        }
    }
}
