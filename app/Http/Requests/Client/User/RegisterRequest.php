<?php

namespace App\Http\Requests\Client\User;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'co_name'  => ['required', 'string', 'max:255', 'unique:cooperation_accounts,name'],
            'mobile'   => ['required', 'string', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'    => 'Email is required!',
            'name.required'     => 'Name is required!',
            'co_name.required'  => 'Cooperation name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
