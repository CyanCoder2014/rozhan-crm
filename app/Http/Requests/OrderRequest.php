<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'services.*.service_id' => ['required','exists:services,id'],
            'services.*.person_id' => ['required','exists:persons,id'],
            'date' => ['required'],
            'start_at' => ['required'],
            'end_at' => ['required']
        ];
    }
}
