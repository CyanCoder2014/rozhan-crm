<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactReminderRequest extends FormRequest
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
            'contact_ids.*' =>['nullable','exists:contacts,id'],
            'except_contact_ids.*' =>['nullable','exists:contacts,id'],
            'tag_ids.*' =>['nullable','exists:c_tags,id'],
            'except_tag_ids.*' =>['nullable','exists:c_tags,id'],
            'group_ids.*' =>['nullable','exists:contact_groups,id'],
            'title' => ['required'],
            'description' => ['required'],
            'email' =>[],
            'sms' =>[],
            'db' =>[],
            'reminder_at'=> ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'execute_at'=> ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
        ];
    }
}
