<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactNotifyByGroupRequest extends FormRequest
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
            'group_ids.*' =>['required','exists:contact_groups,id'],
            'message' => ['string','required'],
            'email' =>[],
            'sms' =>[],
            'db' =>[],
        ];
    }
}
