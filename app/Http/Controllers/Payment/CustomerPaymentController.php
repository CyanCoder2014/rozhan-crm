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
                'description'
            ]
        );
        return $this->model->with(['account'])->paginate();
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