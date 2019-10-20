<?php


namespace Modules\TicketingModule\Http\Repository;


use Modules\TicketingModule\Entities\Ticket;
use Modules\TicketingModule\Entities\TicketMessage;
use Modules\TicketingModule\Http\Requests\TicketRequest;
use Modules\TicketingModule\Http\Requests\TicketResponedRequest;

class TicketCRUD
{

    public function create(TicketRequest $request){
        $ticket = Ticket::create(array_merge(
            $request->only('answerable_id','category_id'),
            [
                'owner_id' => auth()->id(),
                'status' => Ticket::waiting_status,
                'active' => 1
            ]
        ));
        $ticket->messages()->save(
            TicketMessage::make(
                array_merge(
                    $request->only('title','description'),
                    [
                        'owner_id' => auth()->id(),
                        'status' => TicketMessage::waiting_status,
                    ]
                )
            )
        );
    }

    public function reply(TicketResponedRequest $request,Ticket $ticket){


        $ticket->messages()->save(
            TicketMessage::make(
                array_merge(
                    $request->only('title','description','reply_to'),
                    [
                        'owner_id' => auth()->id(),
                        'status' => ($ticket->owner_id == auth()->id())?TicketMessage::waiting_status:TicketMessage::answer_status,
                    ]
                )
            )
        );
        $ticket->status = ($ticket->owner_id == auth()->id())?Ticket::waiting_status:Ticket::answered_status;
        $ticket->save();
    }

}