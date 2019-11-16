<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\ClientOrderRequest;
use App\Http\Requests\Client\ClientPreOrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Order;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrvImpl;
use App\User;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $model;
    protected $orderService;


    public function __construct(OrderSrvImpl $orderService)
    {
        $this->model = new Order();
        $this->orderService = $orderService;

    }





    public function index()
    {
        $data = Order::where('user_id',auth()->id())->with(['OrderServices','OrderServices.person','OrderServices.service','user'])->get();

        return $this->response($data);
    }


    public function show($id)
    {
        $data = Order::where('id',$id)->where('user_id',auth()->id())
            ->with(['OrderServices','OrderServices.person','OrderServices.service','user'])
            ->first();
        if ($data)
            return $this->response($data);
        else
            return abort(404);
    }


    public function update(ClientOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id != auth()->id())
            return abort(404);
        if (!$order->CanClientEdit())
            return abort(403);
        $data = [];
        return $this->response($data);
    }


    public function store(ClientOrderRequest $request,$id)
    {
        if (!$this->orderService->is_OwnerOfCacheCache($id,auth()->id()))
            return abort(404);
        $array = $this->orderService->addOrder($request,$id);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function preOrder(ClientPreOrderRequest $request)
    {
        $array = $this->orderService->addOrderCache($request,auth()->user());
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function serviceSchedule($id)
    {
        if (!$this->orderService->is_OwnerOfCacheCache($id,auth()->id()))
            return abort(404);
        $array = $this->orderService->getOrderCache($id);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }


    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id != auth()->id())
            return abort(404);
        if (!$order->CanClientCancel())
            return abort(403);
        $order->state = Order::cancel_state;
        $order->save();
        return '';
    }
}
