<?php

namespace App\Repositories;



use App\Order;
use App\OrderService;
use App\Person;
use App\Service;
use App\User;
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
     *                              ]
     *              ]
     *              ->date (date)
     *              ->start_at (time)
     *              ->end_at (time)
     *
     */

    public function addOrder()
    {
        $services =\request('services');

        return DB::transaction(function () use ($services){

            $order = Order::create([
                'user_id' => auth()->id(),
                'title' => null,
                'description' => null,
                'file' => null,
                'general_price' => null,
                'general_discount' => null,
                'general_tax' => null,
                'final_price' => null,
                'general_date' => null,
                'general_start' => null,
                'general_end' => null,
                'type' => null,
                'state' => null,
                'created_by' => auth()->id(),
                'updated_by' => null,
                'deleted_on' => null,
            ]);


            foreach ($services as $serv){
                $service = Service::findOrFail($serv['service_id']);
                $person = Person::findOrFail($serv['person_id']);
                if (! $person->hasService($service))
                    return 'perosn has not a service';
                if (!$this->Booking($order,$service,$person,\request('date'),\request('start_at'),\request('end_at')))
                    return 'perosn is not available';


            }
            return $order;
        });



        // show persons of services after select services

        // create order
        // check timing of selected persons    // خطا نمونه:  خانم محمودی در بازه انخابی حاضر نیستند
        // add services to order
        // add persons to order
        // add timing





    }


    public function editOrder()
    {

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



    private function Booking(Order $order,Service $service,Person $person,$date,$start_time,$end_time):bool {
        if(! $person->isAvailabe($date,$start_time,$end_time))
            return false;
        OrderService::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'person_id'=> $person->id,
            'note' => null,
            'number' => null,
            'price' => $service->price,
            'discount' => $service->default_discount,
            'tax' => $service->tax,
            'date' => $date,
            'start' => $start_time ,
            'state' => null,
            'created_by' => $order->user_id,
            'updated_by' => null,
            'deleted_on' => null,
        ]);

        return true;
    }


}
