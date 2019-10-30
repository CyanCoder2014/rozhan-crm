<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepotRequest;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report1(RepotRequest $request){

        $groupBy=[];



        switch (request('filter')){
            case 'service':
                $groupBy[]='service_id';
                break;
            case 'user':
                $groupBy[]='user_id';
                break;
        }
        switch (request('time')){
            case 'y':
                $groupBy[]=DB::raw('YEAR(order_services.created_at)');
                break;
            case 'm':
                $groupBy[]=DB::raw('MONTH(order_services.created_at)');
                break;
            case 'w':
                $groupBy[]=DB::raw('WEEK(order_services.created_at)');
                break;
            case 'd':
                $groupBy[]=DB::raw('DAY(order_services.created_at)');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('DAY(order_services.created_at)');
                break;
        }
        switch (request('order')){
            case 'price':
                $order='total';
                break;
            default:
                $order='order_services.created_at';
                break;
        }
        switch (request('sort')){
            case 'inc':
                $order_sort='inc';
                break;
            default:
                $order_sort='desc';
                break;
        }

        return Order::
        select('order_services.service_id',DB::raw('order_services.created_at'),'user_id',DB::raw('SUM(order_services.price) as total'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from','1398/01/01')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to','1398/12/29')))
            ->where('orders.state',Order::created_status)
            ->join('order_services','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort)
            ->get()

            ;

    }
}
