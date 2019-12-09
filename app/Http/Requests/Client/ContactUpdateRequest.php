<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personal_code'=>[],
            'image',
            'first_name',
            'last_name',
            'mobile'=>['required'],
            'email',
            'tell',
            'country',
            'city',
            'address',
            'location',
            'post_code',
            'national_code',
            'type',
            'state',
            'group_id'
        ];
    }
}
