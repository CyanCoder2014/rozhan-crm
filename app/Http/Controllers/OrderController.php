<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Order;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrvImpl;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $ContactRepository;
    protected $contact;
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
        $data = $this->appRepository->getById($id, $this->model);
        return $this->response($data);
    }


    public function update(Request $request, $id)
    {

        $data = $this->appRepository->edit($request , $id, $this->model);
        return $this->response($data);
    }


    public function store(OrderRequest $request)
    {
        $data = $this->orderService->addOrder();
        return $this->response($data);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }






}
