<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialDateRequest extends FormRequest
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
            'contact_id'=>['required','exists:contacts,id'],
            'title'=>['required','string'],
            'special_date'=>['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is not jalili time.');
                }
            }],
            'percent'=>['required','integer'],
            'type'=>['required','integer'],
            'state'=>[],
//            'discount_id'=>['required','exists:discounts,id']
        ];
    }

    public function casts($keys = null)
    {
        $all = parent::all($keys);
        $all['special_date'] = to_georgian_date($all['special_date']);
        return $all;
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['contact_id'] = $this->route('contact_id');
        return $data;
    }
}
