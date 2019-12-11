<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactReviewRequest extends FormRequest
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
            'contact_id' => ['required','exists:contacts,id'],
            'rate' => ['required','between:0,5'],
            'comment' => ['required'],
            ];
    }
    public function all($keys = null)
    {
        $all = parent::all($keys);
        $all['contact_id'] = $this->route('contact');
        return $all;
    }
}
