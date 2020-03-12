<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\RepotRequest;
use App\Http\Requests\UserReportRequest;
use App\Order;
use App\OrderProduct;
use App\OrderService;
use App\Payment\CompanyPayment;
use App\Payment\CustomerPayment;
use Carbon\Carbon;
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
            case 'asc':
                $order_sort='asc';
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
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<',to_georgian_date(\request('date_to')))
            ->where('orders.state','!=', Order::cancel_state)
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
            case 'asc':
                $order_sort='asc';
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
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<',to_georgian_date(\request('date_to')))
            ->where('orders.state','!=', Order::cancel_state)
            ->join('orders','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $query->limit($request->limit);
        $query = $query->get();

//        return $query;

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
                foreach ($query as $row){

                    $contactLabel = 'نا مشخص';
                    if (Contact::where('user_id', $row->user_id)->first() != null){
                        $contactLabel = Contact::where('user_id', $row->user_id)->first()->last_name;
                    }

                    $output[]=[
                        'label' => $contactLabel,
                        'value' => $row->total
                    ];
                }

                return $output;
            case 'person':

                foreach ($query as $row){
                    $personLabel = 'نا مشخص';
                    if ($row->person != null)
                        $personLabel = $row->person->name.' '.$row->person->family;

                    $output[]=[
                        'label' => $personLabel,
                        'value' => $row->total
                    ];
                }


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
            case 'asc':
                $order_sort='asc';
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
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<',to_georgian_date(\request('date_to')))
            ->where('orders.state','!=', Order::cancel_state)
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
                $groupBy[]=DB::raw('YEAR(orders.general_date)');
                break;
            case 'm':
                $groupBy[]=DB::raw('MONTH(orders.general_date)');
                break;
            case 'w':
                $groupBy[]=DB::raw('WEEK(orders.general_date)');
                break;
            case 'd':
                $groupBy[]=DB::raw('orders.general_date');
                break;
            default:
                if(count($groupBy) == 0)
                    $groupBy[]=DB::raw('orders.general_date');
                break;
        }
        switch (request('order')){
            case 'price':
                $order='total';
                break;
            default:
                $order='orders.general_date';
                break;
        }
        switch (request('sort')){
            case 'asc':
                $order_sort='asc';
                break;
            default:
                $order_sort='desc';
                break;
        }

        $query = OrderProduct::
        select('orders.user_id','order_products.product_id',
            DB::raw('orders.general_date'),'user_id',
            DB::raw('SUM(order_products.price + order_services.price) as total'),
            DB::raw('WEEK(orders.general_date) as week'))
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<',to_georgian_date(\request('date_to')))
            ->where('orders.state','!=', Order::cancel_state)
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
            case 'asc':
                $order_sort='asc';
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
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<',to_georgian_date(\request('date_to')))
            ->where('orders.state','!=', Order::cancel_state)
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









    public function generalServiceReport(RepotRequest $request){

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
            case 'asc':
                $order_sort='asc';
                break;
            default:
                $order_sort='desc';
                break;
        }

        $serviceQuery = OrderService::
        with(['service','person'])->
        select('order_services.service_id','orders.user_id','order_services.person_id',
            DB::raw('order_services.created_at'),'user_id',
            DB::raw('SUM(order_services.price) as total'),
            DB::raw('COUNT(order_services.id) as servicesNumber'),
            DB::raw('WEEK(order_services.created_at) as week'))
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->where('orders.state','!=', Order::cancel_state)
            ->join('orders','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $serviceQuery->limit($request->limit);
        $serviceQuery = $serviceQuery->with(['service'])->get();

        return $serviceQuery;
    }




    public function generalProductReport(RepotRequest $request){

        $groupBy=[];
        switch (request('filter')){
            case 'product':
                $groupBy[]='product_id';
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
            case 'asc':
                $order_sort='asc';
                break;
            default:
                $order_sort='desc';
                break;
        }

        $productQuery = OrderProduct::
        select('orders.user_id','order_products.product_id',
            DB::raw('order_products.created_at'),'user_id',
            DB::raw('SUM(order_products.price) as total'),
            DB::raw('COUNT(order_products.id) as productNumber'),
            DB::raw('WEEK(order_products.created_at) as week'))
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->where('orders.state','!=', Order::cancel_state)
            ->join('orders','orders.id','order_products.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $productQuery->limit($request->limit);
        $productQuery = $productQuery->with(['product'])->get();

        return $productQuery;
    }



    public function generalCostReport(RepotRequest $request){

        $costQuery = CompanyPayment::
        select('type',
            DB::raw('SUM(company_payments.amount) as total'),
            DB::raw('WEEK(company_payments.created_at) as week'))
            ->where('company_payments.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('company_payments.created_at','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->groupBy('type')->get();

        return $costQuery;
    }




    public function generalOrderReport(RepotRequest $request){

        $orderQuery = Order::
        select(
            DB::raw('orders.general_date'),'user_id',
            DB::raw('COUNT(orders.user_id) as clientNumber'),
            DB::raw('COUNT(orders.id) as total'),
            DB::raw('SUM(orders.final_price) as total_price'))
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->where('orders.state','!=', Order::cancel_state)
            ->get();

        return $orderQuery;
    }




    public function generalPaymentReport(RepotRequest $request){

        $costQuery = CustomerPayment::
        select('type', 'account','accounts.title',
            DB::raw('SUM(customer_payments.amount) as total'),
            DB::raw('WEEK(customer_payments.created_at) as week'))
            ->where('customer_payments.created_at','>=',to_georgian_date(\request('date_from')))
            ->where('customer_payments.created_at','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->join('accounts','accounts.id','customer_payments.account')
            ->groupBy(['account'])->get();

        return $costQuery;
    }









    public function generalPersonReport(RepotRequest $request){

        $groupBy=[];
        $groupBy[]='person_id';

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
            case 'asc':
                $order_sort='asc';
                break;
            default:
                $order_sort='desc';
                break;
        }

        $serviceQuery = OrderService::
        with(['service','person'])->
        select('order_services.service_id','orders.user_id','order_services.person_id',
            DB::raw('order_services.created_at'),'user_id',
            DB::raw('SUM(order_services.price) as total'),
            DB::raw('COUNT(order_services.id) as serveNumber'),
            DB::raw('COUNT(orders.user_id) as clientNumber'),
            DB::raw('WEEK(order_services.created_at) as week'))
            ->where('orders.general_date','>=',to_georgian_date(\request('date_from')))
            ->where('orders.general_date','<=',(new Carbon(to_georgian_date(to_georgian_date(\request('date_to')))))->addDays(1))
            ->where('orders.state','!=', Order::cancel_state)
            ->join('orders','orders.id','order_services.order_id')
            ->groupBy($groupBy)
            ->orderBy($order,$order_sort);
        if (isset($request->limit) && ctype_digit($request->limit))
            $serviceQuery->limit($request->limit);
        $serviceQuery = $serviceQuery->with(['service'])->get();

        return $serviceQuery;
    }








}









