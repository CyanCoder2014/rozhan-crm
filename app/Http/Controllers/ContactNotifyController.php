<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactTag;
use App\Http\Requests\ContactNotifyByGroupRequest;
use App\Http\Requests\ContactNotifyByTagRequest;
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
        if ($contacts->count() > 0)
        {
            Notification::send($contacts,new MessageNotification($request->message,$methods));
            return $this->response(null,'success',200);
        }
        else
            return $this->response(null,'مخاطبی پیدا نشد',400);
    }
    public function sendByGroup(ContactNotifyByGroupRequest $request){
        $methods=[];
        if ($request->sms)
            $methods[]='sms';
        if ($request->email)
            $methods[]='email';
        if ($request->db)
            $methods[]='db';
        if (is_array($request->group_ids) && count($request->group_ids) > 0)
            $contacts = Contact::whereIn('group_id',$request->group_ids);
        else
            $contacts = Contact::whereNotNull('id');

        $contacts = $contacts->get();
        if ($contacts->count() > 0)
        {
            Notification::send($contacts,new MessageNotification($request->message,$methods));
            return $this->response(null,'success',200);
        }
        else
            return $this->response(null,'مخاطبی پیدا نشد',400);
    }
    public function sendByTag(ContactNotifyByTagRequest $request){
        $methods=[];
        if ($request->sms)
            $methods[]='sms';
        if ($request->email)
            $methods[]='email';
        if ($request->db)
            $methods[]='db';

        $tag_ids = $request->tag_ids;
        $except_tag_ids = $request->tag_except_ids;
        $contacts = Contact::select('*');
        if (is_array($tag_ids) && count($tag_ids) > 0)
            $contacts = $contacts->whereHas('ConatctTags' , function($query) use ($tag_ids){
                    $query->whereIn('tag_id',$tag_ids)->groupBy('contact_id');
                    return $query;
        });
        if (is_array($except_tag_ids) && count($except_tag_ids) > 0)
        {
            $except_contact_ids = ContactTag::where('tag_id',$except_tag_ids)->groupby('contact_id')->get()->pluck('contact_id');
            $contacts->whereNotIn('id',$except_contact_ids);

        }
//        dd($contacts->toSql());

        $contacts = $contacts->get();
        if ($contacts->count() > 0)
        {
            Notification::send($contacts,new MessageNotification($request->message,$methods));
            return $this->response(null,'success',200);
        }
        else
            return $this->response(null,'مخاطبی پیدا نشد',400);

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
