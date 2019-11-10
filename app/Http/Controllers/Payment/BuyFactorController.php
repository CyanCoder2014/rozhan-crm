<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseAPIController;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Payment\BuyFactor;

class BuyFactorController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new BuyFactor();
    }

    protected function validationRules(){
        return [
            'product_code'=>[],
            'product_name'=>[],
            'product_description'=>[],
            'numbers'=>[],
            'unit'=>[],
            'unit_price'=>[],
            'discount'=>[],
            'final_price'=>[],
            'factor_date'=>[],
            'tax'=>[],
            'price_plus_tax'=>[],
            'account_id'=>[],
            'buy_type'=>[],
            'description'=>[],
            'full_name'=>[],
            'national_code'=>[],
            'register_number'=>[],
            'address'=>[],
            'post_code'=>[],
            'tell_number'=>[],
            'economic_code'=>[],
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
