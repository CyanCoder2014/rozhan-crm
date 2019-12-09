<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Http\Requests\Order\CustomerPaymentRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\MessageNotification;
use App\Notifications\TemplateNotification;
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

        $columns =    ['title', 'description', 'file','general_price', 'general_discount', 'general_tax', 'final_price', 'general_date', 'general_start', 'general_end',];
        $search_column =   ['title', 'description', 'general_start', 'general_end'];
        $with =['OrderServices','OrderServices.person','OrderServices.service','OrderProducts','OrderProducts.product','user'];
        if ( \request()->input('showdata') ) {
            return $this->model::orderBy('created_at', 'desc')->get();
        }
        $length = \request()->input('length',15);
        $column = \request()->input('column');
        $order = \request()->input('order','desc');
        $search_input = \request()->input('search');
        $query = $this->model::select(array_merge($columns,['id','created_at']))
            ->orderBy($columns[$column]??'id',$order);
        if ($with)
            $query->with($with);
        if ($search_input) {
            $query->where(function($query) use ($search_input,$search_column) {

                foreach ($search_column as $key => $column)
                    if ($key == array_key_first($search_column))
                        $query->where($column, 'like', '%' . $search_input . '%');
                    else
                        $query->orWhere($column, 'like', '%' . $search_input . '%');
//                    ->orWhere('mobile', 'like', '%' . $search_input . '%')
//                    ->orWhere('email', 'like', '%' . $search_input . '%')
//                    ->orWhere('tell', 'like', '%' . $search_input . '%');
//                    ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }
        $data = $query->paginate($length);
        return $data;

        return Order::with(['OrderServices','OrderServices.person','OrderServices.service','OrderProducts','OrderProducts.product','user'])->orderBy('id', 'desc')->paginate();

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

        if (isset($array['data']))
        {
            $contacts = Contact::whereNotNull('id');
            $contacts->where('user_id',$array['data']->user_id);
            $contacts = $contacts->get();

            Notification::send($contacts,new TemplateNotification('Reserve',['sms','db'],'#120'.$array['data']->id,null,null, 'همکاران با شما درتماس خواهند بود', null));
//        Notification::send($contacts,new MessageNotification('درخواست شما با موفقیت در سالن زیبایی ثبت شد',['sms']));


        }


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
