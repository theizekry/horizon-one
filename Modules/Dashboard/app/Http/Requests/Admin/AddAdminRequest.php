<?php

namespace Modules\Dashboard\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Dashboard\Rules\InternationalPhoneNumberFormat;

class AddAdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
            ],
            'email' => [
                'sometimes',
                'nullable',
                'string',
                'email',
                Rule::unique('admins', 'email'),
            ],
            'username' => [
                'required',
                Rule::unique('admins', 'username'),
                'alpha_num',
                'regex:/^(?=.*[A-Za-z])[A-Za-z0-9]+$/',
                'min:3',
                'max:50',
            ],
            'phone_number' => [
                'required',
                Rule::unique('admins', 'phone_number'),
                new InternationalPhoneNumberFormat,
            ],
            //            'profile_image' => [
            //                'sometimes',
            //                'nullable',
            //                'file',
            //                'max:2048', //  2 megabytes
            //                'mimes:png,jpg,jpeg',
            //            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
            //            'role' => [
            //                'required',
            //                Rule::exists('roles', 'id'),
            //            ],
            //            'is_blocked' => [
            //                'required',
            //                'boolean',
            //            ],
        ];
    }

    /**
     * Prepare Before apply validations.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        //        $this->merge([
        //            'is_blocked' => $this->has('is_blocked'),
        //        ]);
    }
}
