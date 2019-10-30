<?php

namespace App\Repositories;



use App\Order;
use App\OrderService;
use App\Person;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderSrvImpl
{

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

    public function addOrderCache(Request $request)
    {


        $services =$request->services;
        $start = Carbon::createFromFormat('Y-m-d',to_georgian_date($request->date));
        $order = new Order([
            'user_id' => auth()->id(),
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
            'state' => Order::created_status,
            'created_by' => auth()->id(),
            'updated_by' => null,
            'deleted_on' => null,
        ]);
        $order_cache_id = rand(1,100000);
        while (true){

            if (!Cache::has('preorder_id_'.$order_cache_id))
                break;
            $order_cache_id = rand(1,100000);

        }
        Cache::put('preorder_id_'.$order_cache_id,compact('order','services'));



        return ['message' =>'successful','data' =>route('order.step2',['id'=>$order_cache_id])];




        // show persons of services after select services

        // create order
        // check timing of selected persons    // خطا نمونه:  خانم محمودی در بازه انخابی حاضر نیستند
        // add services to order
        // add persons to order
        // add timing





    }

    public function getOrderCache($id){
        if (!Cache::has('preorder_id_'.$id))
            return ['message' =>'not found','data' => null,'status' => 404];
        $cacheData = Cache::get('preorder_id_'.$id);
        $orderServices = $cacheData['services']??[];
        $order = $cacheData['order']??new Order();
        $date = to_jalali_date($order->general_date);
        $person_selected = array_column($orderServices, 'person_id', 'service_id');
        $services = Service::with('persons')->whereIn('id',array_column($orderServices, 'service_id'))->get();

        foreach ($services as $service)
            foreach ($service->persons as $person){
                $person->timeSchedule = $person->dateTimeSchedule($order->general_date);
                if (isset($person_selected[$service->id])&& $person_selected[$service->id] == $person->id)
                    $person->selected = true;
            }

        return ['message' =>'successful','data' =>compact('services','date')];





    }

    public function addOrder(Request $request,$id)
    {

        $cacheData = Cache::pull('preorder_id_'.$id);

        return DB::transaction(function () use ($request,$cacheData){
            $services =$request->services;
            $start = Carbon::createFromFormat('Y-m-d',to_georgian_date($request->date));
            $order = $cacheData['order']??new Order([
                    'user_id' => auth()->id(),
                    'title' => null,
                    'description' => null,
                    'file' => null,
                    'general_price' => null,
                    'general_discount' => null,
                    'general_tax' => null,
                    'final_price' => null,
                    'general_date' => $start->format('Y-m-d'),
                    'general_start' => null,
                    'general_end' => null,
                    'type' => null,
                    'state' => Order::created_status,
                    'created_by' => auth()->id(),
                    'updated_by' => null,
                    'deleted_on' => null,
                ]);
            $order->save();



            $price = 0;
            $general_start = $start->clone()->setTime(23,59);
            $general_end = $start->clone()->setTime(0,0);
            $newOrderServices=[];
            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                $person = Person::findOrFail($serv['person_id']);
                $start_time = explode(':',$serv['start_at']);
                $start->setTime($start_time[0],$start_time[1]);
                $end = $start->clone()->addMinutes($service->max_time);
                $price += $service->priceCalculate();

                /********************* set start and end of  the order ***************************/
                if ($general_start->gt($start))
                    $general_start = $start->clone();
                if ($general_end->lt($end))
                    $general_end = $end->clone();
                /********************* make new Order Services***************************/
                $newOrderService = $this->BookService(
                    $service,
                    $person,
                    $start->format('Y-m-d'),
                    $start->format('H:i'),
                    $end->format('H:i'),
                    $serv['note']??null);
                /********************** validate the service request **************************/
                if (! $person->hasService($service)){
                    return ['message' =>'perosn has not a service','status'=>400];
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
            $order->general_start = $general_start->format('H:i:s');
            $order->general_end = $general_end->format('H:i:s');
            $order->final_price = $price;
            $order->save();
            $order->OrderServices()->saveMany($newOrderServices);

            return ['message' =>'successful','data' =>$order];
        });



        // show persons of services after select services

        // create order
        // check timing of selected persons    // خطا نمونه:  خانم محمودی در بازه انخابی حاضر نیستند
        // add services to order
        // add persons to order
        // add timing





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
    public function editOrder(Request $request ,Order $order)
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
//                'state' => Order::created_status,
//                'created_by' => auth()->id(),
//                'updated_by' => null,
//                'deleted_on' => null,
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
            'deleted_on' => null,
        ]);
        return $orderService;

        return true;
    }


}
