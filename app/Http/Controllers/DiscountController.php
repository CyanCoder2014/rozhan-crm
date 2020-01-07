<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\Http\Requests\OrderDiscountRequest;
use App\Order;
use App\Repositories\DiscountRepository;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $repository;
    public function __construct(DiscountRepository $repository)
    {
        $this->repository =$repository;
    }
    public function list()
    {
        return Discount::select('id','title')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $columns =    ['title', 'quantity', 'type', 'amount', 'amount_type', 'code', 'start_at', 'expired_at', 'status',];
        $search_column =   ['title', 'code',];
        $with = ['products','services','contacts'];
        if ( \request()->input('showdata') ) {
            return Discount::orderBy('created_at', 'desc')->get();
        }
        $length = \request()->input('length',15);
        $column = \request()->input('column');
        $order = \request()->input('order','desc');
        $search_input = \request()->input('search');
        $query = Discount::select(array_merge($columns,['id','created_at']))
            ->where('type' , 0)->orderBy($columns[$column]??'id',$order);
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
        return Discount::with('products','services','contacts')->orderBy('id', 'desc')->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        $rep =$this->repository->add($request->all());
        return $this->response($rep['data']??null,$rep['message']??null,$rep['status']??200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        $discount->products;
        $discount->services;
        $discount->contacts;
        $discount->castDate();
        return $this->response($discount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountUpdateRequest $request, Discount $discount)
    {
        $rep = $this->repository->edit($request->all(),$discount);
        return $this->response($rep['data']??null,$rep['message']??null,$rep['status']??200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $this->repository->delete($discount);

    }
    public function notify(Discount $discount,Request $request)
    {
        $this->repository->notify($discount);

    }
    public function remind(Discount $discount,Request $request)
    {
        $this->repository->remind($discount);

    }



    public function ApplyDiscountToOrder(OrderDiscountRequest $request)
    {
        $discount= Discount::where('code',$request->code)->first();
        if (!$discount)
            return  $this->response( null,'کد تخفیف وجود ندارد',  400);
        $order = Order::find($request->order_id);
        $statAndmessage = $discount->CanUse($order->user);
        if ($statAndmessage['status'] != 200)
            return  $this->response( null, $statAndmessage['message'], 400);
        if ($order->discount()->count() > 0)
            return $this->response( null,'تخفیف برای این سفارش قبلا ثبت شده',  400);

        $rep= $this->repository->Apply($discount,$order);
        return $this->response($rep['data']??null,$rep['message']??null,$rep['status']??200);



    }
}
