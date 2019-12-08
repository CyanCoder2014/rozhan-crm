<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactNotifyByTagRequest extends FormRequest
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
            'tag_ids.*' =>['nullable','exists:c_tags,id'],
            'tag_except_ids.*' =>['nullable','exists:c_tags,id'],
            'message' => ['string','required'],
            'email' =>[],
            'sms' =>[],
            'db' =>[],
        ];
    }
}
