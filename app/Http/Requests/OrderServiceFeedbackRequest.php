<?php

namespace App\Http\Requests;

use App\OrderService;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Schema;

class OrderServiceFeedbackRequest extends FormRequest
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
            'order_service_id' => ['required','exists:order_services,id',function ($attribute, $value, $fail){
                    $orderservice = OrderService::find($value);
                    if ($orderservice->state != OrderService::complete_status)
                        $fail($attribute.'سرویس شما به تمام نرسیده');
            }],
            'rate' => ['between:0,10','integer'],
            'comment' => ['nullable','string']
        ];
    }
}
