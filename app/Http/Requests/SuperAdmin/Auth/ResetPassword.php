<?php

namespace App\Http\Requests\SuperAdmin\Auth;

use App\Http\Requests\BaseFormRequest;

class ResetPassword extends BaseFormRequest
{
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'old_password' => ['required'],
            'password'     => ['required', 'string', 'min:8']
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
            'password.required'     => 'Password is required!',
            'old_password.required' => 'Old password is required!',
        ];
    }
}
