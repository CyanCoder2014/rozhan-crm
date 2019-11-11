<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseAPIController;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;
use App\Payment\CompanyPayment;

class CompanyPaymentController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new CompanyPayment();
    }

    protected function validationRules(){
        return [
            'id'=>[],
            'number'=>['required'],
            'reason'=>[],
            'buyer'=>[],
            'recipient'=>[],
            'recipient_code'=>[],
            'recipient_name'=>[],
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
            'receiver_account'=>[],
            'payed'=>[],
            'type'=>[],
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
