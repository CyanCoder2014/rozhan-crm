<?php

namespace Modules\EventModule\Http\Controllers;

use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EventModule\Entities\Event;
use Modules\EventModule\Entities\EventRegister;
use Modules\EventModule\Entities\EventRegiterInfo;
use Modules\EventModule\Http\Requests\RegisterEventRequest;

class EventRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $events = Event::where('user_id',auth()->id())->get();
        return view('eventmodule::eventRegister.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Event $event)
    {
        if($event->SuccessRegistered()->where('user_id',auth()->id())->get()->sum('quantity') >= $event->quantity_limit)
            return back()->with('message','شما در حد ظرفیت خود ثبت نام انجام داده اید');
        if (Carbon::now()->gt($event->end_registration))
            return back()->with('warning','زمان ثبت نام به پایان رسیده');
        if (Carbon::now()->lt($event->start_registration))
            return back()->with('warning','زمان ثبت نام به شروع نشده');
        if ($event->status == 0)
            return back()->with('warning','رویداد فعال نیست');
        if ($event->residualCapacity() <= 0)
            return back()->with('warning','ظرفیت رویداد تکمیل شده است');
        if (ctype_digit(\request()->get('quantity')))
            if (\request()->get('quantity') < $event->quantity_limit)
                $quantity = \request()->get('quantity');
            else
                $quantity =$event->quantity_limit;
        else
            $quantity = 1;
        return view('eventmodule::eventRegister.register',compact('quantity','event'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(RegisterEventRequest $request)
    {


        $event = Event::findOrFail($request->event_id);
        $residualUserCapacity = $event->quantity_limit - $event->SuccessRegistered()->where('user_id',auth()->id())->get()->sum('quantity');

        if (Carbon::now()->gt($event->end_registration))
            return back()->with('warning','زمان ثبت نام به پایان رسیده');
        if($residualUserCapacity <= 0)
            return back()->with('message','شما در حد ظرفیت خود ثبت نام انجام داده اید');
        if (Carbon::now()->lt($event->start_registration))
            return back()->with('warning','زمان ثبت نام به شروع نشده');
        if ($event->status == 0)
            return back()->with('warning','رویداد فعال نیست');
        if ($event->residualCapacity() <= 0)
            return back()->with('warning','ظرفیت رویداد تکمیل شده است');

        $registerInfos = [];
        for ($i=0;$i < $residualUserCapacity && $i < count($request->infos); $i++){
            $registerInfos[]= new EventRegiterInfo([
                'status' => EventRegiterInfo::created_status,
                'name' => $request->infos[$i]['name'],
                'national_code' => $request->infos[$i]['national_code'],

            ]);
        }
        $register = new EventRegister();
        $register->fill([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'status' => EventRegister::created_status,
            'quantity' => $i+1,
            'payment_id' => '',
            'tracking_code' => EventRegister::CreateTrickingCode()
        ]);
        $register->save();
        $register->infos()->saveMany($registerInfos);
        if ($event->price > 0)
            return $this->PayingRoute($register);
        else
            return $this->CompeleteRegister($register);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('eventmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('eventmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function PayingRoute(EventRegister $eventRegister){
        $eventRegister->status = EventRegister::payment_status;
        // $eventRegister->payment_id ; // todo payment serice
        $eventRegister->save();
        // return payment_rotue
        $returnRoute='';
    }
    public function paymentSuccess(EventRegister $eventRegister){
        $eventRegister->status = EventRegister::payed_status;
        $eventRegister->save();
        // return payment_rotue
        $returnRoute='';
    }
    public function paymentUnSuccess(EventRegister $eventRegister){
        $eventRegister->status = EventRegister::payment_canceled_status;
        $eventRegister->save();
        // return payment_rotue
        $returnRoute='';
    }

    public function CompeleteRegister(EventRegister $eventRegister){
        $eventRegister->status = EventRegister::success_status;
        $eventRegister->save();
        return view('eventmodule::eventRegister.afterRegister',compact('eventRegister'));

    }
}
