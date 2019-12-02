<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Discount;
use App\Http\Requests\OrderDiscountRequest;
use App\Order;
use App\Repositories\DiscountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientDiscountController extends Controller
{
    protected $repository;
    public function __construct(DiscountRepository $repository)
    {
        $this->repository =$repository;
    }
    public function ApplyDiscountToOrder(OrderDiscountRequest $request)
    {
        $discount= Discount::where('code',$request->code)->first();
        $order = Order::find($request->order_id);
        if ($order->user_id != auth()->id() )
            return abort(404);
        $statAndmessage = $discount->CanUse($order->user);
        if ($statAndmessage['status'] != 200)
            return ['message' => $statAndmessage['message'], 'status' => 400];
        if ($order->discount()->count() > 0)
            return ['message' => 'تخفیف برای این سفارش ثبت شده', 'status' => 400];

        $rep= $this->repository->Apply($discount,$order);
        return $this->response($rep['data']??null,$rep['message']??null,$rep['status']??200);



    }
}
