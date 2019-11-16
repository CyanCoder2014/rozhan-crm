<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientOrderRequest extends FormRequest
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
            'products.*.product_id' => ['exists:products,id'],
            'products.*.amount' => ['integer'],
            'services.*.service_id' => ['required','exists:services,id'],
            'services.*.person_id' => ['required','exists:persons,id'],
            'services.*.start_at' => ['required','date_format:H:i'],
            'services.*.note' => ['nullable','string'],
            'date' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
        ];
    }
}
