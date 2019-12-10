<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Discount;
use App\Http\Requests\SpecialDateRequest;
use App\Repositories\DiscountRepository;
use App\Services\ReminderService\ReminderObjectValue;
use App\SpecialDate;
use Illuminate\Http\Request;

class SpecialDateController extends Controller
{
    protected $discountRepository;
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository =$discountRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contact_id)
    {
        return SpecialDate::with('discount')->where('contact_id',$contact_id)->paginate();
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
    public function store(SpecialDateRequest $request,$contact_id)
    {
        $new = new SpecialDate();
        $new->fill($request->casts());
        $new->created_by = auth()->id();
        $new->contact_id = $contact_id;
        $discount_data = [
            'title'=>$request->title,
            'quantity'=>1,
            'type'=>Discount::special_date_type,
            'amount'=>$request->percent,
            'amount_type'=>Discount::percent_amount_type,
            'code'=>'event-'.rand(1,100).$contact_id,
            'contacts' =>[$contact_id],
            'start_at'=> $request->special_date,
            'expired_at'=> $request->special_date
        ];
        $discount = $this->discountRepository->add($discount_data)['data'];
        $new->discount_id = $discount->id;
        $new->save();
        return $this->response($new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function show($contact_id,SpecialDate $specialDate)
    {
        $specialDate->discount;
        $specialDate->special_date = to_jalali_date($specialDate->special_date);
        return $this->response($specialDate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function edit($contact_id,SpecialDate $specialDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialDateRequest $request,$contact_id, SpecialDate $specialDate)
    {
        if ($specialDate->contact_id != $contact_id)
            return $this->response(null,'');
        $specialDate->fill($request->casts());
        $specialDate->updated_by = auth()->id();
        $discount_data = [
            'title'=>$request->title,
            'quantity'=>1,
            'type'=>Discount::special_date_type,
            'amount'=>$request->percent,
            'amount_type'=>Discount::percent_amount_type,
            'code'=>$specialDate->discount->code,
            'contacts' =>[$contact_id],
            'start_at'=> $request->special_date,
            'expired_at'=> $request->special_date
        ];
        $discount = $this->discountRepository->edit($discount_data,$specialDate->discount)['data'];
        $specialDate->save();
        return $this->response($specialDate);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id,SpecialDate $specialDate)
    {
        if ($specialDate->contact_id != $contact_id)
            abort(404);
        $specialDate->delete();
        return $this->response($specialDate);

    }

    public function setReminder(SpecialDate $specialDate)
    {
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($specialDate->title);
        $reminder->setDesctiprion('');
        $reminder->setReminderAt(\DateTime::createFromFormat('Y-m-d H:i:s',$specialDate->special_date.''));//
        $reminder->setExecuteAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->executeAt)));
        $reminder->setReceiverId(auth()->contact->id);
        $reminder->setReceiverName(Contact::class);
        $reminder->setDb(1);
        $reminder->setEmail(0);
        $reminder->setSms(0);
        $reminder->setSenderId(auth()->id());
        $reminder->setSenderName('App\User');


        $data = $this->service->Send($reminder);
    }
}
