<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Order;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrv;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class OrderController extends BaseAPIController
{

    protected $ContactRepository;
    protected $contact;
    protected $orderService;


    public function __construct(AppRepository $appRepository , OrderSrv $orderService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Order();
        $this->orderService = $orderService;

    }





    public function addOrder()
    {

        // show persons of services after select services

        // create order
        // check timing of selected persons    // خطا نمونه:  خانم محمودی در بازه انخابی حاضر نیستند
        // add services to order
        // add persons to order
        // add timing



    }


    public function editOrder()
    {

    }


    public function deleteOrder()
    {

    }


    public function changeOrderState()
    {

    }


    public function makePayment()
    {

    }


    public function printPayment()
    {

    }


    public function payPayment()
    {

    }


    public function revokePayment()
    {

    }






}
