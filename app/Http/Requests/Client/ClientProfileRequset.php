<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientProfileRequset extends FormRequest
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
            'contact_id'=>[],
            'age'=>[],
            'major'=>[],
            'education_field'=>[],
            'work_field'=>[],
            'national_code'=>[],
            'gender'=>[],
            'birth'=>[],
            'about'=>[],
            'visitor_note'=>[],
            'type'=>[],
            'state'=>[],
        ];
    }
}
