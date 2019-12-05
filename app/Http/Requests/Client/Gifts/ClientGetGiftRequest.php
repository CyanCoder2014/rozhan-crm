<?php

namespace App\Http\Requests\Client\Gifts;

use Illuminate\Foundation\Http\FormRequest;

class ClientGetGiftRequest extends FormRequest
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
            'gift_id' => ['required','exists:score_gifts,id']
        ];
    }
}
