<?php

namespace App\Repositories;



use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface OrderSrv
{

    public function getOrders();
    public function getOrderById();
    public function addOrder(Request $request);
    public function editOrder(Request $request,Order $order);
    public function deleteOrder();
    public function changeOrderState();
    public function makePayment();
    public function printPayment();
    public function payPayment();
    public function revokePayment();


}
