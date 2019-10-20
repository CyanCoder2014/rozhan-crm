<?php

namespace Modules\EventModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EventModule\Entities\Event;

class EventController extends Controller
{


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Event $event)
    {
        return view('eventmodule::event.show',compact('event'));
    }


}
