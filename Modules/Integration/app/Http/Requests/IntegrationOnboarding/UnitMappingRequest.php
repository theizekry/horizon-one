<?php

namespace Modules\Integration\Http\Requests\IntegrationOnboarding;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Integration\Enums\FieldType;
use Illuminate\Foundation\Http\FormRequest;

class UnitMappingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Wizard Step 3

        return [
            'name'                   => ['required', 'string'],
            'fields'                 => ['required', 'array', 'min:1'],
            'fields.*.id'            => ['required', Rule::exists('system_fields', 'id')],
            'fields.*.alias'         => ['required'],
            'fields.*.type'          => ['required', new Enum(FieldType::class)],
            'fields.*.relation_name' => ['required_if:fields.*.type,' . FieldType::RELATION->stringVal()],
            'integration_id'         => ['required', Rule::exists('integrations', 'id')],
        ];
    }
}
