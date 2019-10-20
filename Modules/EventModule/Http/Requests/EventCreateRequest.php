<?php

namespace Modules\EventModule\Http\Requests;

use App\City;
use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','string'],
            'price' => ['required','integer'],
            'description' => ['required'],
            'capacity' => ['required','integer'],
            'quantity_limit' => ['required','integer'],
            'city_id' => ['required','exists:cities,id'],
            'category_id' => ['required','exists:event_categories,id'],
            'event_start_at' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail(' فرمت تاریخ فیلد زمان شروع رویداد درست نیست ');
                }
            }],
            'event_end_at' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail(' فرمت تاریخ فیلد زمان پایان رویداد درست نیست ');
                }
            }],
            'start_registration' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail(' فرمت تاریخ فیلد زمان شروع ثبت نام درست نیست ');
                }
            }],
            'end_registration' => ['required',function ($attribute, $value, $fail) {
                if (!validate_jalili_datetime($value)) {
                    $fail(' فرمت تاریخ فیلد زمان پایان ثبت نام درست نیست ');
                }
            }]
        ];
    }

    public function casting(){
        return [
            'title' => $this->input('title'),
            'price' => (int)$this->input('price'),
            'status' => (int)$this->input('status'),
            'capacity' => (int)$this->input('capacity'),
            'quantity_limit' => (int)$this->input('quantity_limit'),
            'city_id' => (int)$this->input('city_id'),
            'province_id' => City::find($this->input('city_id'))->province_id,
            'category_id' => (int)$this->input('category_id'),
            'description' => $this->input('description'),
            'address' => $this->input('address'),
            'event_start_at' => to_georgian($this->input('event_start_at')),
            'event_end_at' => to_georgian($this->input('event_end_at')),
            'start_registration' => to_georgian($this->input('start_registration')),
            'end_registration' => to_georgian($this->input('end_registration'))
        ];
    }


    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'price' => 'قیمت',
            'capacity' => 'ظرفیت',
            'quantity_limit' => 'حد تعداد ثبت نام برای هر کاربر',
            'city_id' => 'شهر',
            'category_id' => 'nsji fknd',
            'event_start_at' => 'تاریخ شروع رویداد',
            'event_end_at' => 'تاریخ پایان رویداد',
            'start_registration' => 'تاریخ شروع ثبت نام',
            'end_registration' => 'تاریخ پایان ثبت نام'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }
}
