<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseAPIController;
use App\Repositories\AppRepositoryImpl;
use App\Payment\Account;

class AccountController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Account();
    }
    public function index()
    {
        return parent::dataTables([
            'title',
            'name',
            'number',
            'details',
            'debt',
            'credit',
            'collecting_balance',
            'balance',
            'bank',
            'sheba',
        ],[

            'title',
            'name',
            'details',
            'sheba',
        ]);
        return $this->model->paginate();
    }

    protected function validationRules(){
        return [
            'title'=>[],
            'name'=>[],
            'number'=>[],
            'details'=>[],
            'debt'=>[],
            'credit'=>[],
            'collecting_balance'=>[],
            'balance'=>[],
            'bank'=>[],
            'sheba'=>[],
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