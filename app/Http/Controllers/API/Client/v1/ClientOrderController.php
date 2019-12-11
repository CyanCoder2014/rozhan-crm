<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\ClientOrderRequest;
use App\Http\Requests\Client\ClientPreOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Order;
use App\Repositories\OrderSrvImpl;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOrderController extends Controller
{
    protected $orderService;
    protected $model;
    public function __construct(OrderSrvImpl $orderService)
    {
        $this->orderService = $orderService;
        $this->model = Order::class;
    }

    public function index()
    {
//        $data = $this->appRepository->getAll($this->model);
        return $this->model::
            where('user_id',auth()->id())->
            with(['OrderServices','OrderServices.person','OrderServices.service','OrderProducts','OrderProducts.product','user'])
            ->paginate();

//        return $this->response($data);
    }


    public function show($id)
    {
        $data = $this->model::where('user_id',auth()->id())
            ->where('id',$id)
            ->with(['OrderServices','OrderServices.person','OrderServices.service','OrderServices.feedback','user'])
            ->first();
        $feedback= true;
        foreach ($data->OrderServices as $orderService)
            if (!$orderService->feedback)
                $feedback = false;
        $data->isFeedbacked = $feedback;
        return $this->response($data);
    }

    public function store(ClientOrderRequest $request,$id)
    {
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

    public function update(ClientOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id != auth()->id())
            return abort(404);
        if (!$order->CanClientEdit())
            return abort(403);
        $data = [];

        // todo update order
        return $this->response($data);
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
    public function getAvailableServices(Request $request)
    {

        $data = Service::
        with(['serviceCategory','persons'])
            ->get();


        foreach ($data as $key => $service){

            $persons_available_flag =false;
            foreach ($service->persons as $person){
                if (count($person->availableTimeService(to_georgian_date($request->date),$service)) > 0 )
                    $persons_available_flag =true;
            }

            if (!$persons_available_flag)
                unset($data[$key]);

        }

        return $this->response($data);
    }
}
