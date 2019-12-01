<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactNotifyRequest;
use App\Notifications\MessageNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (is_array($request->contact_ids) && count($request->contact_ids) > 0)
            $contacts = Contact::whereIn('id',$request->contact_ids);
        else
            $contacts = Contact::whereNotNull('id');
        if($request->state)
            $contacts->where('state',$request->state);

        $contacts = $contacts->get();
        Notification::send($contacts,new MessageNotification($request->message,$methods));
    }




    public function headerInbox()
    {

        $notifications = Auth::user()->notifications();


//        $notificationId = $id;
//
//        if($id !== '0'){
//            $notification = Auth::user()->notifications()->where('id', $id)->first();
//            $notification->markAsRead();
//        }
//        $notifications->where('type', 'App\Notifications\Event')->take(400)->markAsRead();


        return $this->response($notifications);
    }
}
