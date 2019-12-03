<?php

namespace App\Repositories;



use App\Discount;
use App\Http\Requests\OrderDiscountRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Order;
use App\OrderProduct;
use App\OrderService;
use App\Payment\CustomerPayment;
use App\Person;
use App\PersonService;
use App\Product;
use App\Service;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderSrvImpl
{
    protected $scoreService;
    public function __construct(UserScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    public function getOrders()
    {


    }


    public function getOrderById()
    {

    }

    /**
     * @input $request
     *              ->services =[
     *                              [
     *                                  service_id => ,
     *                                  person_id =>
     *                                  note =>
     *                                  start_at (time) =>
     *                                  end_at (time) =>
     *                              ]
     *              ]
     *              ->date (date)
     *              ->description
     *
     * @output [
     *              message
     *              data
     *          ]
     */

    public function addOrderCache($request,User $user)
    {
        $services =$request->services;
        $product_ids = array_column($request->products??[], 'product_id');
        $productModels =Product::whereIn('id',$product_ids)->get()->keyBy('id')->all();

        foreach ($request->products??[] as $product)
            if (!isset($productModels[$product['product_id']]->remaining_number) or
                $productModels[$product['product_id']]->remaining_number < $product['amount'])
                return ['message' =>'product has not available amount','status'=>400];
        $products =$request->products??[];
        $start = Carbon::createFromFormat('Y-m-d',to_georgian_date($request->date));
        $order = new Order([
            'user_id' => $user->id,
            'title' => null,
            'description' => $request->description,
            'file' => null,
            'general_price' => null,
            'general_discount' => null,
            'general_tax' => null,
            'final_price' => null,
            'general_date' => $start->format('Y-m-d'),
            'general_start' => $request->start_at,
            'general_end' => $request->end_at,
            'type' => null,
            'state' => Order::created_state,
            'created_by' => auth()->id(),
            'updated_by' => null,
            'deleted_at' => null,
        ]);
        $order_cache_id = rand(1,100000);
        while (true){

            if (!Cache::has('preorder_id_'.$order_cache_id))
                break;
            $order_cache_id = rand(1,100000);

        }
        ///////////////////////////////// check if there is available service in this date ////////////////////
        $availableServices = PersonService::whereIn('service_id',array_column($services,'service_id'))
            ->whereHas('personTiming',function ($query) use($request){
                $query->where('date', to_georgian_date($request->date));
            })->get()->keyBy('service_id');
        foreach ($services as $service) {
            $serviceObject = Service::with('persons')->findOrFail($service['service_id']);
            if (!array_key_exists($service['service_id'],$availableServices->all())){

                return ['message' =>'سرویس '.$serviceObject->title.' در این تاریخ وجود ندارد','status'=>400];
            }
            /************** check is a available person per service *************/
            $persons_available_flag =false;
            foreach ($serviceObject->persons as $key => $person)
                if (count($person->availableTimeService($order->general_date,$serviceObject)) > 0 )
                    $persons_available_flag =true;
            if (! $persons_available_flag)
                return ['message' =>'ظرفیت خالی برای سرویس '.$serviceObject->title.' در این تاریخ وجود ندارد','status'=>400];
            /****************************************************************/
            if (isset($service['person_id']) && !in_array($service['person_id'],$availableServices->pluck('person_id')->all()))
                return ['message' =>'فرد '.$service['person_id'].' در این تاریخ در دسترس نیست','status'=>400];
        }
        //////////////////////////////////////////////////////////////////////////////////////////////////////

        Cache::put('preorder_id_'.$order_cache_id,compact('order','services','products'));



//        return ['message' =>'successful','data' =>route('order.step2',['id'=>$order_cache_id])];
        return ['message' =>'successful','data' =>$order_cache_id];







    }

    public function getOrderCache($id){
        if (!Cache::has('preorder_id_'.$id))
            return ['message' =>'not found','data' => null,'status' => 404];
        $cacheData = Cache::get('preorder_id_'.$id);
        $orderServices = $cacheData['services']??[];
        $products = $cacheData['products']??[];
        $order = $cacheData['order']??new Order();
        $date = to_jalali_date($order->general_date);
        $dateTime = Carbon::createFromFormat('Y-m-d',$order->general_date)->setTime(0,0,1);

        $person_selected = array_column($orderServices, 'person_id', 'service_id');
        $services = Service::with('persons')->whereIn('id',array_column($orderServices, 'service_id'))->get();

        $sugestion=[
            'date' =>$order->general_date,
            'services' => []
        ];
        foreach ($services as $service){
            $availblePerson=[];
            foreach ($service->persons as $key => $person){
                $person->timeSchedule = $person->dateTimeSchedule($order->general_date);
                foreach ($person->availableTimeService($order->general_date,$service) as $availableTime){
                    $person->availableTime = $availableTime;
                    $availblePerson[]= clone $person;
                }
                if (isset($person_selected[$service->id])&& $person_selected[$service->id] == $person->id)
                    $person->selected = true;
            }
            $sugestPerson = $service->highestScoreAvailablePerson($dateTime);
            if($sugestPerson)
            {
                $time = explode(':',$sugestPerson->availableTime['end']);
                $dateTime->setTime($time[0],$time[1]);
                $sugestion['services'][] = [
                    'serviceObject' => $service,
                    'personObject' => $sugestPerson,
                    'person_id' => $sugestPerson->id,
                    'service_id' => $service->id,
                    'start_at' => convert_time($sugestPerson->availableTime['start']),
//                    'end_at' => $sugestPerson->availableTime['end'],
                ];

            }
            $service->availblePerson = $availblePerson;
        }


        return ['message' =>'successful','data' =>compact('services','date','cacheData','sugestion','products')];





    }

    public function addOrder($request,$id)
    {

        $cacheData = Cache::get('preorder_id_'.$id);
        if(!isset($cacheData['order']))
            return ['message' =>'order does not exist','status'=>400];

        return DB::transaction(function () use ($request,$cacheData){
            $services =$request->services;
            $start = Carbon::createFromFormat('Y-m-d',to_georgian_date($request->date));
            $order = $cacheData['order'];
            $order->save();

            $price = 0;
            $general_start = $start->clone()->setTime(23,59);
            $general_end = $start->clone()->setTime(0,0);
            /*************************** add order Services **********/
            $newOrderServices=[];
            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                $person = Person::findOrFail($serv['person_id']);
                $start_time = explode(':',$serv['start_at']);
                $start->setTime($start_time[0],$start_time[1]);
                $end = $start->clone()->addMinutes($service->max_time);
                $price += $serv['price']??$service->priceCalculate();

                /********************* set start and end of  the order ***************************/
                if ($general_start->gt($start))
                    $general_start = $start->clone();
                if ($general_end->lt($end))
                    $general_end = $end->clone();
                /********************* make new Order Services***************************/
                $newOrderService = new OrderService();
                $newOrderService->fill([
                    'service_id' => $service->id,
                    'person_id'=> $person->id,
                    'note' => $serv['note']??null,
                    'number' => null,
                    'price' => $serv['price']??$service->price,
                    'discount' => $service->default_discount,
                    'tax' => $service->tax,
                    'date' => $start->format('Y-m-d'),
                    'start' => $start->format('H:i') ,
                    'end' => $end->format('H:i') ,
//                    'state' => OrderService::created_status,
                    'state' => 0,
                    'created_by' => auth()->id(),
                    'updated_by' => null,
                    'deleted_at' => null,
                ]);
                /********************** validate the service request **************************/
                if (! $person->hasService($service)){
                    return ['message' =>'person has not a service','status'=>400];
                }
                if(! $person->isAvailabe(
                    $start->format('Y-m-d'),
                    $start->format('H:i'),
                    $end->format('H:i')
                ))
                {
                    return ['message' => 'perosn is not available', 'status' => 400];
                }
                foreach ($newOrderServices as $orderService)
                    if ($orderService->hasConflictWith($newOrderService)){
                        return ['message' =>'services has conflict with eachother','status'=>400];
                    }
                /********************* add Order service if has no validation error *****************************/
                $newOrderServices[] =$newOrderService;


            }
            /************************* add order products *****************/
            $newOrderProducts=[];
            $product_ids = array_column($request->products??[], 'product_id');
            $products =Product::whereIn('id',$product_ids)->get()->keyBy('id')->all();
            foreach ($request->products??[] as $product){
                if (!isset($products[$product['product_id']]->remaining_number) or
                    $products[$product['product_id']]->remaining_number < (int)$product['amount'])
                    return ['message' =>'product has not available amount','status'=>400];
                $price += $product['price']??$products[$product['product_id']]->priceCalculate();
                $newOrderProducts[] = new OrderProduct([
                    'product_id' => $product['product_id'],
                    'note' => $product['note']?? null,
                    'unit' => $product['unit']?? null,
                    'amount' => $product['amount']?? null,
                    'price' => $product['price']??$products[$product['product_id']]['price']??0,
                    'discount' => $products[$product['product_id']]['default_discount']??0,
                    'tax' => $products[$product['product_id']]['tax']??0 ,
                    'date' => $order->general_date,
                    'start' => null,
                    'end' => null,
                    'type' => null,
                    'state' => null,
                    'created_by' => auth()->id(),
                    'updated_by' => null,
                ]);
            }
            /*******************************************************/
            $order->general_start = $general_start->format('H:i:s');
            $order->general_end = $general_end->format('H:i:s');
            $order->final_price = $price;
            $order->save();
            $order->OrderServices = $order->OrderServices()->saveMany($newOrderServices);
            $order->OrderProducts = $order->OrderProducts()->saveMany($newOrderProducts);

            return ['message' =>'successful','data' =>$order];
        });
        Cache::forget('preorder_id_'.$id);


        // show persons of services after select services

        // create order
        // check timing of selected persons    // خطا نمونه:  خانم محمودی در بازه انخابی حاضر نیستند
        // add services to order
        // add persons to order
        // add timing





    }
    public function addOrderQuick($request, User $user)
    {

        return DB::transaction(function () use ($request,$user){
            $services =$request->services;
            $start = Carbon::createFromFormat('Y-m-d',to_georgian_date($request->date));
            $order = new Order([
                'user_id' => $user->id,
                'title' => null,
                'description' => $request->description,
                'file' => null,
                'general_price' => null,
                'general_discount' => null,
                'general_tax' => null,
                'final_price' => null,
                'general_date' => $start->format('Y-m-d'),
                'general_start' => $request->start_at,
                'general_end' => $request->end_at,
                'type' => Order::quick_type,
                'state' => Order::created_state,
                'created_by' => auth()->id(),
            ]);

            $price = 0;

            $newOrderServices=[];
            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                if (isset($serv['person_id']))
                    $person = Person::findOrFail($serv['person_id']);
                else
                    $person = new Person();
                $price += $service->priceCalculate();


                /********************* make new Order Services***************************/

                $orderService = new OrderService();
                $orderService->fill([
                    'service_id' => $service->id,
                    'person_id'=> $person->id,
                    'note' => $serv['note']??null,
                    'number' => null,
                    'price' => $service->price,
                    'discount' => $service->default_discount,
                    'tax' => $service->tax,
                    'date' => $start->format('Y-m-d'),
                    'state' => OrderService::created_status,
                    'type' => OrderService::quick_type,
                    'created_by' => auth()->id(),
                ]);
                /********************* add Order service if has no validation error *****************************/
                $newOrderServices[] =$orderService;


            }
            /************************* add order products *****************/
            $newOrderProducts=[];
            $product_ids = array_column($request->products??[], 'product_id');
            $products =Product::whereIn('id',$product_ids)->get()->keyBy('id')->all();
            foreach ($request->products??[] as $product){
                if (!isset($products[$product['product_id']]->remaining_number) or
                    $products[$product['product_id']]->remaining_number < (int)$product['amount'])
                    return ['message' =>'product has not available amount','status'=>400];
                $price += $product['price']??$products[$product['product_id']]->priceCalculate();
                $newOrderProducts[] = new OrderProduct([
                    'product_id' => $product['product_id'],
                    'note' => $product['note']?? null,
                    'unit' => $product['unit']?? null,
                    'amount' => $product['amount']?? null,
                    'price' => $product['price']??$products[$product['product_id']]['price']??0,
                    'discount' => $products[$product['product_id']]['default_discount']??0,
                    'tax' => $products[$product['product_id']]['tax']??0 ,
                    'date' => $order->general_date,
                    'start' => null,
                    'end' => null,
                    'type' => null,
                    'state' => null,
                    'created_by' => auth()->id(),
                    'updated_by' => null,
                ]);
            }
            /*******************************************************/
            $order->final_price = $price;
            $order->save();
            $order->OrderServices = $order->OrderServices()->saveMany($newOrderServices);
            $order->OrderProducts = $order->OrderProducts()->saveMany($newOrderProducts);

            return ['message' =>'successful','data' =>$order];
        });


    }


    /**
     * @input $request
     *              ->order_id
     *              ->services =[
     *                              [
     *                                  service_id => ,
     *                                  person_id =>
     *                                  note =>
     *                              ]
     *              ]
     *              ->date (date)
     *              ->start_at (time)
     *              ->end_at (time)
     *              ->description
     *
     * @output [
     *              message
     *              data
     *          ]
     */
    public function editOrder( $request ,Order $order)
    {
//        return DB::transaction(function () use ($request,$order){
//            $services =$request->services;
//            $start = Carbon::createFromFormat('Y-m-d H:i',to_georgian($request->date.' '.$request->start_at));
//            if(! $order->is_editable())
//                return ['message' =>'order is not editable'];
//            $order->fill([
//                'user_id' => auth()->id(),
//                'title' => null,
//                'description' => $request->description,
//                'file' => null,
//                'general_price' => null,
//                'general_discount' => null,
//                'general_tax' => null,
//                'final_price' => null,
//                'general_date' => $start->format('Y-m-d'),
//                'general_start' => $request->start_at,
//                'general_end' => $request->end_at,
//                'type' => null,
//                'state' => Order::created_state,
//                'created_by' => auth()->id(),
//                'updated_by' => null,
//                'deleted_at' => null,
//            ]);
//
//
//
//            $price = 0;
//            $oldServices = $order->services;
//            foreach ($services as $serv){
//                $service = Service::findOrFail($serv['service_id']);
//                $person = Person::findOrFail($serv['person_id']);
//
//                if (! $person->hasService($service))
//                    return ['message' =>'perosn has not a service'];
//
//                if (!$this->BookService($service,$person,
//                    $start->format('Y-m-d'),$start->format('H:i'),$start->addMinutes($service->max_time)->format('H:i:s')
//                    ,$serv['note']??null,
//                    $oldServices->shift()))
//                    return ['message' =>'perosn is not available'];
//                $price += $service->priceCalculate();
//
//            }
//            $order->general_end = $start->format('H:i:s');
//            $order->final_price = $price;
//            $order->save();
//
//            return ['message' =>'successful','data' =>$order];
//        });

    }


    public function deleteOrder()
    {

    }

    public function payedOrder(Order $order)
    {

        if (!Order::canChangeState($order->state,Order::payed_state))
            return ['message' =>'نمی توان سفارش را پرداخت کرد','status'=>400];
        $order->state = Order::payed_state;
        $order->save();
        return ['message' =>'successful','data' =>$order];

    }
    public function CompleteOrder(Order $order)
    {
        if (!Order::canChangeState($order->state, Order::complete_state))
            return ['message' => 'نمی توان سفارش را کامل کرد', 'status' => 400];
        $order->state = Order::complete_state;
        foreach ($order->OrderServices as $OrderServices)
        {
            $OrderServices->state = OrderService::complete_state;
            if (is_int($OrderServices->service->score))
            {
                $this->scoreService->addScore($OrderServices->service->score,$OrderServices->service,$order->user,'بابت خرید سرویس');
            }
            $OrderServices->save();
        }

        foreach ($order->OrderProducts as $OrderProducts)
        {
            $OrderProducts->state = OrderProduct::complete_state;
            if (is_int($OrderProducts->product->score))
            {
                $this->scoreService->addScore($OrderProducts->product->score,$OrderProducts->product,$order->user,'بابت خرید محصول');
            }
            $OrderProducts->save();
        }
        $order->save();
        return ['message' =>'successful','data' =>$order];

    }

    public function changeOrderState()
    {

    }


    public function makePayment()
    {

    }


    public function printPayment()
    {

    }


    public function payPayment()
    {

    }


    public function revokePayment()
    {

    }



    private function BookService(Service $service,Person $person,$date,$start_time,$end_time,$note,OrderService $orderService= null) {

        if (!$orderService)
            $orderService = new OrderService();
        $orderService->fill([
            'service_id' => $service->id,
            'person_id'=> $person->id,
            'note' => $note,
            'number' => null,
            'price' => $service->price,
            'discount' => $service->default_discount,
            'tax' => $service->tax,
            'date' => $date,
            'start' => $start_time ,
            'end' => $end_time ,
            'state' => OrderService::created_status,
            'created_by' => auth()->id(),
            'updated_by' => null,
            'deleted_at' => null,
        ]);
        return $orderService;

        return true;
    }

    private function addProductToOrder(Order $order,$products){
        foreach ($products as $product)
        {

        }

    }


    public function is_OwnerOfCacheCache($cacheId,$user_id):bool {
        if (!Cache::has('preorder_id_'.$cacheId))
            return false;
        $cacheData = Cache::get('preorder_id_'.$cacheId);
        $order = $cacheData['order']??new Order();
        if ($order->user_id != $user_id)
            return false;
        return true;
    }


}

