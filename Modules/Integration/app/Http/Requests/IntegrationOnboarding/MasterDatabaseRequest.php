<?php

namespace Modules\Integration\Http\Requests\IntegrationOnboarding;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MasterDatabaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Wizard Step 2

        return [
            'db_type'        => ['required', 'in:mysql,mongodb'],
            'db_host'        => ['required', 'string'],
            'db_port'        => ['required', 'integer'],
            'db_name'        => ['required', 'string'],
            'db_username'    => ['required', 'string'],
            'db_password'    => ['nullable', 'string'],
            'integration_id' => ['required', Rule::exists('integrations', 'id')],
        ];
    }
}
