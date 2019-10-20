<?php

namespace App\Repositories;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ContactSrv
{

    public function getOrders();
    public function getOrderById();
    public function addOrder();
    public function editOrder();
    public function deleteOrder();
    public function changeOrderState();
    public function makePayment();
    public function printPayment();
    public function payPayment();
    public function revokePayment();


}
