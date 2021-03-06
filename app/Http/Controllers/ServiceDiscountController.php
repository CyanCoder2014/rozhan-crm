<?php

namespace App\Http\Controllers;

use App\Repositories\AppRepositoryImpl;
use App\ServiceDiscount;
use Illuminate\Http\Request;

class ServiceDiscountController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new ServiceDiscount();
    }
    protected function validationRules()
    {
        return [
            'service_id' => ['required','exists:services,id'],
            'discount_id' => ['required','exists:discounts,id']
        ];
    }

    protected function validationAttributes()
    {
        return parent::validationAttributes(); // TODO: Change the autogenerated stub
    }

    protected function validationMessages()
    {
        return parent::validationMessages(); // TODO: Change the autogenerated stub
    }

}
