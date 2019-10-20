<?php

namespace Modules\EventModule\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EventModule\Entities\Event;
use Modules\EventModule\Entities\EventCategory;
use Modules\EventModule\Http\Requests\EventCreateRequest;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $events = Event::select('events.*');
        if (ctype_digit(\request()->get('id')))
            $events->where('events.id', \request()->get('id'));
        if (ctype_digit(\request()->get('owner')))
            $events->where('events.owner_id',\request()->get('owner'));
        if (ctype_digit(\request()->get('category_id')))
            $events->where('events.category_id',\request()->get('category_id'));
        if (ctype_digit(\request()->get('city_id')))
            $events->where('events.city_id',\request()->get('city_id'));
        if (ctype_digit(\request()->get('status')))
            $events->where('events.status',\request()->get('status'));
        if (\request()->get('start_from') && validate_jalili(\request()->get('start_from'))) {
            $date = to_georgian_date(\request()->get('start_from'));
            $events->where('events.start_registration', '>=', $date);
        }
        if (\request()->get('end_to') && validate_jalili(\request()->get('end_to'))){
            $date = to_georgian_date(\request()->get('end_to'));
            $events->where('events.end_registration','<=',$date);
        }
        if (\request()->get('title')){
            $events->where('title','like','%'.\request()->get('title').'%');
        }


        $events = $events->paginate(20);
        $categories = EventCategory::all();
        return view('eventmodule::admin.event.index',compact('events','categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        
        return view('eventmodule::admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(EventCreateRequest $request)
    {
        $event = new Event();
        $event->fill($request->casting());
        $event->owner_id= auth()->id();
        $event->save();
        return back()->with('message','رویداد با موفقیت به سیستم اضافه شد');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('eventmodule::admin.event.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Event $event)
    {
        $categories = EventCategory::all();
        return view('eventmodule::admin.event.edit',compact('event','categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(EventCreateRequest $request, Event $event)
    {
        $event->fill($request->casting());
        $event->save();
        return redirect(route('eventmodule.admin.event.index'))->with('message','رویداد با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('message','رویداد با موفقیت حذف شد');
    }
}
