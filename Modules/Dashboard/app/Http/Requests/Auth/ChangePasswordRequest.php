<?php

namespace Modules\Dashboard\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Dashboard\Rules\MatchOldPassword;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                new MatchOldPassword,
            ],
            'new_password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ];
    }
}
