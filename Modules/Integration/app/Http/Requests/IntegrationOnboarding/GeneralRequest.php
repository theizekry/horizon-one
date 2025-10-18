<?php

namespace Modules\Integration\Http\Requests\IntegrationOnboarding;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Wizard Step 1

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('integrations'),
            ],
        ];
    }
}
