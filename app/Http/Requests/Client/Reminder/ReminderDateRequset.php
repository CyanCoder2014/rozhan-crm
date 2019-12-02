<?php

namespace App\Http\Requests\Client\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class ReminderDateRequset extends FormRequest
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
            'date_from'=>['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is invalid.');
                }
            }],
            'date_to'=>['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is invalid.');
                }
            }],
        ];
    }
}
