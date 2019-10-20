<?php

namespace App\Http\Requests\Client\User;


use App\Http\Requests\BaseFormRequest;
use App\Http\Requests\CustomValidations;
use Illuminate\Support\Facades\Request;

class ResetPassword extends BaseFormRequest
{
    use CustomValidations;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sameEmail();

        return [
            'email'    => ['required', 'sameEmail:'. Request::user()->email],
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

    public function messages()
    {
        return [
            'password.required' => 'Password is required!',
            'email.same_email'   => 'Email is not a same!'
        ];
    }
}
