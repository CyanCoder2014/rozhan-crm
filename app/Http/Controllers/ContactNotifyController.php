<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactNotifyRequest;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactNotifyController extends Controller
{
    /**
     * @param ContactNotifyRequest $request
     *
     * @bodyParam message string required
     * @bodyParam contact_ids array required
     * @bodyParam sms boolean
     * @bodyParam email boolean
     * @bodyParam db boolean
     * @bodyParam state integer
     */
    public function send(ContactNotifyRequest $request){
        $methods=[];
        if ($request->sms)
            $methods[]='sms';
        if ($request->email)
            $methods[]='email';
        if ($request->db)
            $methods[]='db';
        if($request->state)
            $contacts = Contact::whereIn('id',$request->contact_ids)->where('state',$request->state)->get();
        else
            $contacts = Contact::whereIn('id',$request->contact_ids)->get();
        Notification::send($contacts,new MessageNotification($request->message,$methods));
    }
}
