<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'title'=>['required','string'],
            'quantity'=>['required','integer'],
            'type'=>['required','integer'],
            'amount'=>['required','integer'],
            'amount_type'=>['required','integer'],
            'code'=>['required','string','max:10'],
            'contacts.*' =>['exists:services,id'],
            'services.*' =>['exists:contacts,id'],
            'products.*' =>['exists:products,id'],
            'start_at'=> ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'expired_at'=> ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
        ];
    }
}
