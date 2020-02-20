<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Order;
use App\Payment\CustomerPayment;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactPaymentController extends Controller
{


    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new CustomerPayment();
    }



    public function index($contact_id){

        $data = CustomerPayment::where('contact_id',$contact_id)->paginate();
//        $data = $this->format_date($data);

        return $data;
    }
    public function show($contact_id,$id){

        return $this->response(CustomerPayment::where('contact_id',$contact_id)->where('id',$id)->first());
    }



    public function update($contact_id,$id){
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $payment = CustomerPayment::where('contact_id',$contact_id)->where('id',$id)->first();
        if (!$payment)
            return abort(404);

        /// not ok  --- for test
        $contact = Contact::find($contact_id);
        \request()->request->add([
            'contact_id'=>$contact_id,
            'buyer'=> $contact->first_name.' '.$contact->last_name,
            'register_date'=>to_georgian2(\request()->register_date),
            'due_date'=> to_georgian2(\request()->due_date),
        ]);
        ////

        $payment->fill(\request()->all());
        $payment->updated_by = auth()->id();
        $payment->save();
        return $this->response($payment);
    }




    public function store($contact_id){
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        $contact = Contact::find($contact_id);
        \request()->request->add([
            'contact_id'=>$contact_id,
            'buyer'=> $contact->first_name.' '.$contact->last_name,
            'register_date'=>to_georgian2(\request()->register_date),
            'due_date'=> to_georgian2(\request()->due_date),
        ]);
        $payment = new CustomerPayment();
        $payment->fill(\request()->all());
        $payment->created_by = auth()->id();
        $payment->save();
        return $this->response($payment);
    }





    public function destroy($contact_id,$id){
        $res =CustomerPayment::where('contact_id',$contact_id)->where('id',$id)->delete();
        if (!$res)
            return abort(404);
        return $this->response($res);
    }


//    public function format_date($data)
//    {
//        foreach ($data as $item){
//            $item['register_date']= to_jalali_no_time($item['register_date']);
//            $item['due_date']= to_jalali_no_time($item['due_date']);
//
//        }
//        return $data;
//    }






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















    protected function validationRules(){
        return [
            'number'=>['required'],
            'reason'=>[],
            'buyer'=>[],
            'receive_state'=>[],
            'period'=>[],
            'pay_state'=>[],
            'register_date'=>[],
            'due_date'=>[],
            'amount'=>[],
            'account'=>[],
            'contract_number'=>[],
            'bank'=>[],
            'bank_calculate'=>[],
            'cheque_number'=>[],
            'term'=>[],
            'payment_account'=>[],
            'payed'=>[],
            'type'=>[],
            'finance_state'=>[],
            'description'=>[],
            'state'=>[],
            'status'=>[],
        ];
    }
    protected function validationAttributes(){
        return [];
    }
    protected function validationMessages(){
        return [];
    }

}
