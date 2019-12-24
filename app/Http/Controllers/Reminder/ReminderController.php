<?php

namespace App\Http\Controllers\Reminder;

use App\Contact;
use App\Http\Requests\SendContactReminderRequest;
use App\Http\Requests\SendSelfReminderRequest;
use App\Services\ReminderService\ReminderObjectValue;
use App\Services\ReminderService\ReminderService;
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
    public function contact(Request $request)
    {

        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);

        return $this->service->ContactReminder($request->contact_id,$date_from,$date_to);

    }
    public function user(Request $request)
    {

        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);

        if (auth()->user()->contact)
            return $this->service->ContactReminder(auth()->user()->contact->id,$date_from,$date_to);
        return $this->response(null,'این کاربر اطلاعات تماس ندارد تا بتواند یاداوری برای ان ثبت شود',400);

    }



    public function setRemember(SendSelfReminderRequest $request)
    {
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($request->title);
        $reminder->setDesctiprion($request->description);
        $reminder->setReminderAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->reminderAt)));//
        $reminder->setExecuteAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->executeAt)));
        $reminder->setReceiverId(auth()->user()->contact->id);
        $reminder->setReceiverName(Contact::class);
        $reminder->setDb(1);
        $reminder->setEmail(0);
        $reminder->setSms(0);
        $reminder->setSenderId(auth()->id());
        $reminder->setSenderName('App\User');


        $data = $this->service->Send($reminder);
        return $this->response($data);


    }


    public function sendRemember(SendContactReminderRequest $request)
    {
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($request->title);
        $reminder->setDesctiprion($request->description);
        $reminder->setReminderAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->reminderAt)));//
        $reminder->setExecuteAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->executeAt)));
        $reminder->setReceiverId($request->contactId);
        $reminder->setReceiverName(Contact::class);
        $reminder->setDb(1);
        $reminder->setEmail(0);
        $reminder->setSms(0);
        $reminder->setSenderId(auth()->id());
        $reminder->setSenderName('App\User');

        $data = $this->service->Send($reminder);
        return $this->response($data);

    }


}
