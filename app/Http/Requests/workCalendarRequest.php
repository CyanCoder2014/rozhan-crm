<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class workCalendarRequest extends FormRequest
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
            'date_from' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'date_to' => ['nullable',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'person_ids.*' => ['exists:persons,id']
        ];
    }
}
