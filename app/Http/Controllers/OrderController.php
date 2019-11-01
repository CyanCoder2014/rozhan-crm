<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
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
//        $data = $this->appRepository->getAll($this->model);
        $data = Order::with('OrderServices')->get();

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


    public function store(OrderRequest $request,$id)
    {
        $array = $this->orderService->addOrder($request,$id);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function preOrder(PreOrderRequest $request)
    {
        $array = $this->orderService->addOrderCache($request);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function serviceSchedule($id)
    {
        $array = $this->orderService->getOrderCache($id);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }






}
