<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContactReminderRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['required'],
            'contactId' => ['required','exists:contacts,id'],
            'reminderAt' => ['required', function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'executeAt' => ['required', function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
        ];
    }
}
