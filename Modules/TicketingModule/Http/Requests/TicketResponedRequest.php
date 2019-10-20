<?php

namespace Modules\TicketingModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketResponedRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'reply_to' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'category_id' => 'دسته بندی',
            'reply_to' => 'پاسخ در',
            'answerable_id' => 'گیرنده تیکت',
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
