<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Http\Requests\Order\CustomerPaymentRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\MessageNotification;
use App\Order;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrvImpl;
use App\Repositories\Payment\CustomerPaymentRepository;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    protected $appRepository;
    protected $model;
    protected $orderService;
    protected $customerPaymentRepository;


    public function __construct(AppRepository $appRepository , OrderSrvImpl $orderService,CustomerPaymentRepository $customerPaymentRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Order();
        $this->orderService = $orderService;
        $this->customerPaymentRepository =$customerPaymentRepository;

    }





    public function index()
    {
//        $data = $this->appRepository->getAll($this->model);
        return Order::with(['OrderServices','OrderServices.person','OrderServices.service','OrderProducts','OrderProducts.product','user'])->paginate();

//        return $this->response($data);
    }


    public function show($id)
    {
        $data = Order::where('id',$id)
            ->with(['OrderServices','OrderServices.person','OrderServices.service','user'])
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

        ///// temp code
        $contacts = Contact::whereNotNull('id');
        $contacts->where('user_id',$array['data']->user_id);
        $contacts = $contacts->get();
        Notification::send($contacts,new MessageNotification('درخواست شما با موفقیت در سالن زیبایی ثبت شد',['sms']));



        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function preOrder(PreOrderRequest $request)
    {
        $array = $this->orderService->addOrderCache($request,User::find($request->user_id));
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function serviceSchedule($id)
    {
        $array = $this->orderService->getOrderCache($id);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }

    public function paymentCompleted(CustomerPaymentRequest $request)
    {
        $order= Order::findOrFail($request->order_id);
        $data = $request->all();
        $data['number'] = 'order-'.$order->user_id.$order->id;
        $data['user_id'] = $order->user_id;
        $data['buyer'] = $order->user->name;
        $data['amount'] = $order->final_price;
        $data['register_date'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['due_date'] = Carbon::now()->format('Y-m-d H:i:s');
        $array = $this->orderService->payedOrder($order);
        if ($array['data']) // if order state changed
            $array = $this->customerPaymentRepository->add($data);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function doneOrder(Request $request)
    {
        $order= Order::findOrFail($request->order_id);
        $array = $this->orderService->CompleteOrder($order);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function cancelOrder(Request $request)
    {
        $order= Order::findOrFail($request->order_id);
        $array = $this->orderService->CancelOrder($order);
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }
    public function addOrderQuick(PreOrderRequest $request)
    {
        $array = $this->orderService->addOrderQuick($request,User::find($request->user_id));
        return $this->response($array['data']??null,$array['message']??null,$array['status']??200);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
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
