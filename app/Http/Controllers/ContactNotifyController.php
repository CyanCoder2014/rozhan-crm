<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactNotifyRequest;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactNotifyController extends Controller
{
    public function send(ContactNotifyRequest $request){
        $methods=[];
        if ($request->sms)
            $methods[]='sms';
        if ($request->email)
            $methods[]='email';
        if ($request->db)
            $methods[]='db';
        $contacts = Contact::whereIn('id',$request->contact_ids)->get();
        Notification::send($contacts,new MessageNotification($request->message,$methods));
    }
}
