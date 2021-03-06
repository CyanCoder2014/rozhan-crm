<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientPreOrderRequest extends FormRequest
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
            'services' => ['required','array','min:1'],
            'services.*.service_id' => ['required','exists:services,id'],
            'services.*.person_id' => ['nullable','exists:persons,id'],
            'date' => ['required', function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],

        ];
    }
}
