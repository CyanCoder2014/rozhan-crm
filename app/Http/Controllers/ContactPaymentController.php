<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Order;
use App\Payment\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactPaymentController extends Controller
{


    public function __construct()
    {


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordersSum($contactId)
    {

        $contact = Contact::find($contactId);
        if ($contact != null)
        return Order::where('user_id', $contact->user_id)->where('state', '!=', Order::cancel_state)->sum('final_price');
    }


    public function paymentsSum($contactId)
    {
        return CustomerPayment::where('contact_id',$contactId)->where('pay_state',2)->sum('amount');
    }


    public function orderPaymentsSum($orderId)
    {
        return CustomerPayment::where('order_id',$orderId)->where('pay_state',2)->sum('amount');
    }


}
