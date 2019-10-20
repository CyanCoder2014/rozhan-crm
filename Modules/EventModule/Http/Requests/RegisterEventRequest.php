<?php

namespace Modules\EventModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id' => ['required','exists:events,id'],
            'infos.*.name' => ['required'],
            'infos.*.national_code' => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
