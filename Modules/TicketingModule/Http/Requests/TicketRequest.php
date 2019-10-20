<?php

namespace Modules\TicketingModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'category_id' => 'required|exists:ticket_categories,id',
            'answerable_id' => 'required|exists:users,id',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'category_id' => 'دسته بندی',
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
