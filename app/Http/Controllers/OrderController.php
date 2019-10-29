<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Order;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrvImpl;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $appRepository;
    protected $model;
    protected $orderService;


    public function __construct(AppRepository $appRepository , OrderSrvImpl $orderService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Order();
        $this->orderService = $orderService;

    }





    public function index()
    {
        $data = $this->appRepository->getAll($this->model);
        return $this->response($data);
    }


    public function show($id)
    {
        $data = Order::where('id',$id)
            ->with(['OrderServices','OrderServices.person','OrderServices.service'])
            ->first();
        return $this->response($data);
    }


    public function update(OrderRequest $request, $id)
    {

        $data = $this->appRepository->edit($request , $id, $this->model);
        return $this->response($data);
    }


    public function store(OrderRequest $request)
    {
        $array = $this->orderService->addOrder($request);
        return $this->response($array['data']??null,$array['message']??null);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }






}
