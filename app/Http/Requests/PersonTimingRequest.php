<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PersonTimingRequest extends FormRequest
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
            'id' => ['nullable','exists:person_timings,id'] ,
//            'title' => ['required'] ,
            'description' => [] ,
            'date' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili($value)) {
                    $fail($attribute.' is invalid.');
                }
            }] ,
            'start' => ['required',function ($attribute, $value, $fail) {
        if (!validate_time($value)) {
            $fail($attribute.' is invalid.');
        }
            }] ,
            'end' => ['required',function ($attribute, $value, $fail) {
                if (!validate_time($value)) {
                    $fail($attribute.' is invalid.');
                }
            }] ,
//            'type' => [] ,
//            'state' => [] ,
        ];
    }

    public function all($keys= null)
    {
        $this->request->add($this->route()->parameters());
        return parent::all($keys= null);

    }

    public function casts(){
        $data = $this->all();
        $data['date']= to_georgian_date($data['date']);
        return $data;
    }


    public function castsforDays($i){
        $data = $this->all();
        $data['date']= (new Carbon(to_georgian_date($data['date'])))->addDays($i)  ;
        return $data;
    }

}
