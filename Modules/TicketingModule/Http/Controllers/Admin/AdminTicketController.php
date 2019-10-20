<?php

namespace Modules\TicketingModule\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TicketingModule\Entities\Ticket;
use Modules\TicketingModule\Entities\TicketCategory;
use Modules\TicketingModule\Entities\TicketMessage;
use Modules\TicketingModule\Http\Repository\TicketCRUD;
use Modules\TicketingModule\Http\Requests\TicketRequest;
use Modules\TicketingModule\Http\Requests\TicketResponedRequest;

class AdminTicketController extends Controller
{
    /**
     * @var TicketCRUD
     */
    private $CRUD;
    public function __construct(TicketCRUD $CRUD)
    {
        $this->CRUD = $CRUD;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::select('tickets.*');
        if (ctype_digit($request->id))
            $tickets->where('tickets.id', $request->id);
        if (ctype_digit($request->owner))
            $tickets->where('tickets.owner_id',$request->owner);
        if (ctype_digit($request->answerable))
            $tickets->where('tickets.answerable_id',$request->answerable);
        if (is_array($request->status))
            $tickets->whereIn('tickets.status',$request->status);
        if (isset($request->date_from) && validate_jalili($request->date_from)){
            $date = to_georgian_date($request->date_from);
            $tickets->where('tickets.created_at','>=',$date);
        }
        if (isset($request->title)){
            $tickets->leftJoin('ticket_messages','tickets.id','ticket_messages.ticket_id')->where('title','like','%'.$request->title.'%');
        }
        if (isset($request->date_to) && validate_jalili($request->date_to)){
            $date = to_georgian_date($request->date_to);
            $tickets->where('tickets.created_at','<=',$date);
        }


        $tickets = $tickets->paginate(20);
        $categories = TicketCategory::all();
        return view('ticketingmodule::admin.ticket.index',compact('tickets','categories'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TicketRequest $request)
    {
        $this->CRUD->create($request);
        return back()->with('message','تیکت شما با موفقیت ایجاد شد');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        return view('ticketingmodule::admin.ticket.show',compact('ticket'));
    }


    /**
     * Reply the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function reply(TicketResponedRequest $request,Ticket $ticket)
    {
        $this->CRUD->reply($request,$ticket);
        return back()->with('message','پاسخ تیکت با موفقیت ارسال شد');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

    public function findUser(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }
        $tags = User::where('name','like','%'.$term.'%')->orWhere('email','like','%'.$term.'%')->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name.' ('.$tag->email.')'];
        }
        return \Response::json($formatted_tags);
    }
}
