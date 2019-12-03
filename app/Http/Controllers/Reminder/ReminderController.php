<?php

namespace App\Http\Controllers\Reminder;

use App\Services\ReminderService\ReminderObjectValue;
use App\Services\ReminderService\ReminderService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    /**
     * @var ReminderService
     */
    protected $service;
    public function __construct(ReminderService $service)
    {
        $this->service = $service;
    }

    public function client(Request $request)
    {
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);
        return $this->service->clientsReminder($date_from,$date_to);

    }
    public function personnels(Request $request)
    {
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);
        return $this->service->personnelsReminder($date_from,$date_to);

    }
    public function user(Request $request)
    {

        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);

        return $this->service->UserReminder($request->user_id,$date_from,$date_to);

    }



    public function setRemember(Request $request)
    {
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($request->title);
        $reminder->setDesctiprion($request->description);
        $reminder->setReminderAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->reminderAt)));//
        $reminder->setExecuteAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->executeAt)));
        $reminder->setReceiverId(auth()->id());
        $reminder->setReceiverName('App\User');
        $reminder->setDb(1);
        $reminder->setEmail(0);
        $reminder->setSms(0);
        $reminder->setSenderId(auth()->id());
        $reminder->setSenderName('App\User');


        $data = $this->service->Send($reminder);
        return $this->response($data);


    }


    public function sendRemember(Request $request)
    {
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($request->title);
        $reminder->setDesctiprion($request->description);
        $reminder->setReminderAt(to_georgian_date($request->reminderAt));//
        $reminder->setExecuteAt(to_georgian_date($request->executeAt));
        $reminder->setReceiverId($request->receiverId);
        $reminder->setReceiverName('App\User');
        $reminder->setDb(1);
        $reminder->setEmail(0);
        $reminder->setSms(0);
        $reminder->setSenderId(auth()->id);
        $reminder->setSenderName('App\User');

        $data = $this->service->Send($reminder);
        return $this->response($data);

    }


}
