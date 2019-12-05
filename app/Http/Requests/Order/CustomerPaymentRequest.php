<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CustomerPaymentRequest extends FormRequest
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
            'order_id' =>['required','exists:orders,id'],
            'pay_state' =>['required'],
//            'account' =>['required','exists:accounts,id'],
//            'bank' =>['required'],
//            'description' =>[],
//            'state' =>['required'],
        ];
    }
}
