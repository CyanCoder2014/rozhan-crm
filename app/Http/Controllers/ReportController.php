<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepotRequest;
use App\Http\Requests\UserReportRequest;
use App\Order;
use App\OrderProduct;
use App\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * @param RepotRequest $request
     * @return mixed
     *
     * report all income categories by date and user and service
     */

    public function baseReport(RepotRequest $request){

        $groupBy=[];
        switch (request('filter')){
            case 'service':
                $groupBy[]='service_id';
                break;
            case 'user':
                $groupBy[]='user_id';
                break;
            case 'person':
                $groupBy[]='person_id';
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
                $groupBy[]=DB::raw('order_services.created_at');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('order_services.created_at');
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

        $query = OrderService::
        with(['service','person'])->
        select('order_services.service_id','orders.user_id','order_services.person_id',
            DB::raw('order_services.created_at'),'user_id',
            DB::raw('SUM(order_services.price) as total'),
            DB::raw('WEEK(order_services.created_at) as week'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to')))
            ->where('orders.state',Order::created_state)
            ->join('orders','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();

        return $query;

    }



    public function report1(RepotRequest $request){

        $groupBy=[];
        switch (request('filter')){
            case 'service':
                $groupBy[]='service_id';
                break;
            case 'user':
                $groupBy[]='user_id';
                break;
            case 'person':
                $groupBy[]='person_id';
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
                $groupBy[]=DB::raw('order_services.created_at');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('order_services.created_at');
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

        $query = OrderService::
        select('order_services.service_id','orders.user_id','order_services.person_id',
            DB::raw('order_services.created_at'),'user_id',
            DB::raw('SUM(order_services.price) as total'),
            DB::raw('WEEK(order_services.created_at) as week'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to')))
            ->where('orders.state',Order::created_state)
            ->join('orders','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();

        $output=[];
        switch (request('filter')){
            case 'service':
                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->service->title,
                        'value' => $row->total
                    ];
                return $output;
            case 'user':

                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->user->name,
                        'value' => $row->total
                    ];
                return $output;
            case 'person':

                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->person->name.' '.$row->person->family,
                        'value' => $row->total
                    ];
                return $output;
            default:
                switch (request('time')){
                    case 'y':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'm':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'w':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => $row->week,
                                'value' => $row->total
                            ];
                        return $output;
                    default:
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m-d',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                }
        }


    }

    public function productReport(RepotRequest $request){

        $groupBy=[];
        switch (request('filter')){
            case 'product':
                $groupBy[]='product_id';
                break;
            case 'user':
                $groupBy[]='user_id';
                break;
        }
        switch (request('time')){
            case 'y':
                $groupBy[]=DB::raw('YEAR(order_products.created_at)');
                break;
            case 'm':
                $groupBy[]=DB::raw('MONTH(order_products.created_at)');
                break;
            case 'w':
                $groupBy[]=DB::raw('WEEK(order_products.created_at)');
                break;
            case 'd':
                $groupBy[]=DB::raw('order_products.created_at');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('order_products.created_at');
                break;
        }
        switch (request('order')){
            case 'price':
                $order='total';
                break;
            default:
                $order='order_products.created_at';
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

        $query = OrderProduct::
        select('orders.user_id','order_products.product_id',
            DB::raw('order_products.created_at'),'user_id',
            DB::raw('SUM(order_products.price) as total'),
            DB::raw('WEEK(order_products.created_at) as week'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to')))
            ->where('orders.state',Order::created_state)
            ->join('orders','orders.id','order_products.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();

        $output=[];
        switch (request('filter')){
            case 'product':
                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->product->title,
                        'value' => $row->total
                    ];
                return $output;
            case 'user':

                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->user->name,
                        'value' => $row->total
                    ];
                return $output;
            default:
                switch (request('time')){
                    case 'y':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'm':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'w':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => $row->week,
                                'value' => $row->total
                            ];
                        return $output;
                    default:
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m-d',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                }
        }


    }

    public function incomeReport(RepotRequest $request){

        $groupBy=[];

        switch (request('time')){
            case 'y':
                $groupBy[]=DB::raw('YEAR(orders.created_at)');
                break;
            case 'm':
                $groupBy[]=DB::raw('MONTH(orders.created_at)');
                break;
            case 'w':
                $groupBy[]=DB::raw('WEEK(orders.created_at)');
                break;
            case 'd':
                $groupBy[]=DB::raw('orders.created_at');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('orders.created_at');
                break;
        }
        switch (request('order')){
            case 'price':
                $order='total';
                break;
            default:
                $order='orders.created_at';
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

        $query = OrderProduct::
        select('orders.user_id','order_products.product_id',
            DB::raw('orders.created_at'),'user_id',
            DB::raw('SUM(order_products.price + order_services.price) as total'),
            DB::raw('WEEK(orders.created_at) as week'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to')))
            ->where('orders.state',Order::created_state)
            ->join('orders','orders.id','order_products.order_id')
            ->join('order_services','order_services.order_id','order_products.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();

        $output=[];
        switch (request('filter')){
            case 'product':
                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->product->title,
                        'value' => $row->total
                    ];
                return $output;
            case 'user':

                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->user->name,
                        'value' => $row->total
                    ];
                return $output;
            default:
                switch (request('time')){
                    case 'y':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'm':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'w':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => $row->week,
                                'value' => $row->total
                            ];
                        return $output;
                    default:
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y-m-d',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                }
        }


    }






    public function UserReport(UserReportRequest $request){
        $groupBy=[];
        switch (request('filter')){
            case 'service':
                $groupBy[]='service_id';
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
                $groupBy[]=DB::raw('order_services.created_at');
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

        $query = OrderService::
        select('order_services.service_id','orders.user_id','order_services.person_id',
            DB::raw('order_services.created_at'),'user_id',
            DB::raw('SUM(order_services.price) as total'),
            DB::raw('WEEK(order_services.created_at) as week'))
            ->where('orders.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('orders.created_at','<',to_georgian_date(\request('date_to')))
            ->where('orders.state',Order::created_state)
            ->join('orders','orders.id','order_services.order_id')
            ->where('order_services.person_id',\request('person_id'))
            ->orderBy($order,$order_sort);
        if(count($groupBy) > 0)
            $query->groupBy($groupBy);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();
        $output=[];
        switch (request('filter')){
            case 'service':
                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->service->title,
                        'value' => $row->total
                    ];
                return $output;
            case 'user':

                foreach ($query as $row)
                    $output[]=[
                        'label' => $row->user->name,
                        'value' => $row->total
                    ];
                return $output;
            default:
                switch (request('time')){
                    case 'y':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('Y',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'm':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => \Morilog\Jalali\CalendarUtils::strftime('m',strtotime($row->created_at)),
                                'value' => $row->total
                            ];
                        return $output;
                    case 'w':
                        foreach ($query as $row)
                            $output[]=[
                                'label' => $row->week,
                                'value' => $row->total
                            ];
                        return $output;
                    default:
                        foreach ($query as $row)
                            $output[]=[
                                'label' => 'همه',
                                'value' => $row->total
                            ];
                        return $output;
                }
        }

    }
}
