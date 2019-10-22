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
use Illuminate\Support\Facades\DB;

class OrderSrvImpl implements OrderSrv
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

    public function addOrder(Request $request)
    {


        return DB::transaction(function () use ($request){
            $services =$request->services;
            $start = Carbon::createFromFormat('Y-m-d H:i',to_georgian($request->date.' '.$request->start_at));
            $order = Order::create([
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



            $price = 0;
            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                $person = Person::findOrFail($serv['person_id']);
//                dd(to_georgian($request->date.' '.$request->start_at));

                if (! $person->hasService($service))
                    return ['message' =>'perosn has not a service'];
                if (!$this->Booking($order,$service,$person,
                    $start->format('Y-m-d'),$start->format('H:i'),$start->addMinutes($service->max_time)->format('H:i:s')
                    ,$serv['note']??null))
                    return ['message' =>'perosn is not available'];
                $price += $service->priceCalculate();

            }
            $order->general_end = $start->format('H:i:s');
            $order->final_price = $price;
            $order->save();

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
        return DB::transaction(function () use ($request,$order){
            $services =$request->services;
            $start = Carbon::createFromFormat('Y-m-d H:i',to_georgian($request->date.' '.$request->start_at));
            if(! $order->is_editable())
                return ['message' =>'order is not editable'];
            $order->fill([
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



            $price = 0;
            $oldServices = $order->services;
            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                $person = Person::findOrFail($serv['person_id']);

                if (! $person->hasService($service))
                    return ['message' =>'perosn has not a service'];
                if (!$this->Booking($order,$service,$person,
                    $start->format('Y-m-d'),$start->format('H:i'),$start->addMinutes($service->max_time)->format('H:i:s')
                    ,$serv['note']??null,
                    $oldServices->shift()))
                    return ['message' =>'perosn is not available'];
                $price += $service->priceCalculate();

            }
            $order->general_end = $start->format('H:i:s');
            $order->final_price = $price;
            $order->save();

            return ['message' =>'successful','data' =>$order];
        });

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



    private function Booking(Order $order,Service $service,Person $person,$date,$start_time,$end_time,$note,OrderService $orderService= null):bool {
        if(! $person->isAvailabe($date,$start_time,$end_time))
            return false;
        if (!$orderService)
            $orderService = new OrderService();
        $orderService->fill([
            'order_id' => $order->id,
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
            'created_by' => $order->user_id,
            'updated_by' => null,
            'deleted_on' => null,
        ]);
        $orderService->save();

        return true;
    }


}
