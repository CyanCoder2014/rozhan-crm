<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonServiceRequest extends FormRequest
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
            'person_id' => ['exists:persons,id'] ,
            'services.*.service_id' => ['nullable','exists:services,id'] ,
            'services.*.title' => [] ,
            'services.*.note' => [] ,
//            'services.*.type' => [] ,
//            'services.*.state' => [] ,
        ];
    }

    public function all($keys= null)
    {
        $this->request->add($this->route()->parameters());
        $this->request->add($this->route()->parameters());
        return parent::all($keys= null);

    }

}
