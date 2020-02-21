<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseAPIController;
use App\Repositories\AppRepositoryImpl;
use App\Payment\CustomerPayment;

class CustomerPaymentController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new CustomerPayment();
    }
    public function index()
    {
        return parent::dataTables(
            [
                'number',
                'reason',
                'buyer',
                'receive_state',
                'period',
                'pay_state',
                'register_date',
                'due_date',
                'amount',
                'account',
                'contract_number',
                'bank',
                'bank_calculate',
                'cheque_number',
                'term',
                'payment_account',
                'payed',
                'type',
                'finance_state',
                'description',
                'state',
                'status',
                'created_by',
                'updated_by',
                'user_id',
                'contact_id',
                'order_id',
            ],[
                'number',
                'reason',
                'buyer',
                'receive_state',
                'period',
                'pay_state',
                'contract_number',
                'bank_calculate',
                'cheque_number',
                'payment_account',
                'finance_state',
                'description',
                'contact_id',
                'order_id',
            ],
            ['account']

        );
        return $this->model->with(['account'])->paginate();
    }






    public function store(){

        \request()->request->add([
            'register_date'=>to_georgian2(\request()->register_date),
            'due_date'=> to_georgian2(\request()->due_date),
        ]);

        $payment = new CustomerPayment();
        $payment->fill(\request()->all());
        $payment->created_by = auth()->id();
        $payment->save();
        return $this->response($payment);
    }



    public function update($id){

        $payment = CustomerPayment::where('id',$id)->first();
        if (!$payment)
            return abort(404);

        /// not ok  --- for test
        \request()->request->add([
            'register_date'=>to_georgian2(\request()->register_date),
            'due_date'=> to_georgian2(\request()->due_date),
        ]);
        ////

        $payment->fill(\request()->all());
        $payment->updated_by = auth()->id();
        $payment->save();
        return $this->response($payment);
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