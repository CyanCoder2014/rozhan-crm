<?php

namespace App\Http\Requests\SuperAdmin\Admin;

use App\Http\Requests\BaseFormRequest;

class AddRequest extends BaseFormRequest
{
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password'  => ['required', 'string', 'min:8']
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required'     => 'Email is required!',
            'full_name.required' => 'Full name is required!',
            'password.required'  => 'Password is required!',
        ];
    }
}
