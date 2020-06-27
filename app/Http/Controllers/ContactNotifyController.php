<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactTag;
use App\Http\Requests\ContactNotifyByGroupRequest;
use App\Http\Requests\ContactNotifyByTagRequest;
use App\Http\Requests\ContactNotifyRequest;
use App\Http\Requests\ContactReminderRequest;
use App\Notifications\MessageNotification;
use App\Notifications\TemplateNotification;
use App\Services\ReminderService\ReminderObjectValue;
use App\Services\ReminderService\ReminderService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ContactNotifyController extends Controller
{
    protected $reminderService;
    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

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
        if ($request->sms )
            $methods[]='sms';
        if ($request->email )
            $methods[]='email';
        if ($request->db )
            $methods[]='db';

        $tag_ids = $request->tag_ids;
        $except_tag_ids = $request->except_tag_ids;
        $contact_ids = $request->contact_ids??[];
        $except_contact_ids = $request->except_contact_ids??[];
        $contacts = Contact::select('*');
        if (is_array($request->group_ids) && count($request->group_ids) > 0)
            $contacts = $contacts->whereIn('group_id',$request->group_ids);
        if (is_array($tag_ids) && count($tag_ids) > 0)
            $contacts = $contacts->whereHas('ConatctTags' , function($query) use ($tag_ids){
                $query->whereIn('tag_id',$tag_ids)->groupBy('contact_id');
                return $query;
            });
        if (is_array($except_tag_ids) && count($except_tag_ids) > 0)
        {
            $new_except_contact_ids = ContactTag::where('tag_id',$except_tag_ids)->groupby('contact_id')->get()->pluck('contact_id')->toArray()??[];
//            dd($except_contact_ids,$new_except_contact_ids);
            $except_contact_ids =array_merge($except_contact_ids,$new_except_contact_ids);

        }
        $contact_ids = array_diff($contact_ids,$except_contact_ids);
        if (is_array($except_contact_ids) && count($except_contact_ids) > 0)
            $contacts->whereNotIn('id',$except_contact_ids);

        if (is_array($contact_ids) && count($contact_ids) > 0)
            $contacts = $contacts->orWhereIn('id',$contact_ids);
//        dd($contacts->toSql());

        if($request->state)
            $contacts->where('state',$request->state);


        $contacts = $contacts->get();

        if ($contacts->count() > 0)
        {
            if ($request->sendByTemplate) {
                foreach ($contacts as $contact){
                    $selectedContact = [$contact];
                    Notification::send($selectedContact,new TemplateNotification($request->template,['sms','db'],$contact->getContactCode(),$contact->user_id,$contact->email, $contact->getContactName(), $request->message));
                    return $this->response(null,'success',200);
                }
            }else{
                Notification::send($contacts,new MessageNotification($request->message,$methods));
                return $this->response(null,'success',200);
            }

        }
        else
            return $this->response(null,'مخاطبی پیدا نشد',400);
    }










    public function sendReminder(ContactReminderRequest $request){
        $reminder = new ReminderObjectValue();

        $reminder->setTitle($request->title);
        $reminder->setDesctiprion($request->description);
        $reminder->setReminderAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->reminder_at)));//
        $reminder->setExecuteAt(\DateTime::createFromFormat('Y-m-d H:i:s',to_georgian($request->execute_at)));
        $reminder->setDb(($request->db)? 1: 0);
        $reminder->setEmail(($request->email)? 1: 0);
        $reminder->setSms(($request->sms)? 1: 0);
        $reminder->setReceiverName(Contact::class);
        $reminder->setSenderId(auth()->id());
        $reminder->setSenderName('App\User');

        $tag_ids = $request->tag_ids;
        $except_tag_ids = $request->except_tag_ids;
        $contact_ids = $request->contact_ids??[];
        $except_contact_ids = $request->except_contact_ids??[];
        $contacts = Contact::select('*');
        if (is_array($request->group_ids) && count($request->group_ids) > 0)
            $contacts = $contacts->whereIn('group_id',$request->group_ids);
        if (is_array($tag_ids) && count($tag_ids) > 0)
            $contacts = $contacts->whereHas('ConatctTags' , function($query) use ($tag_ids){
                $query->whereIn('tag_id',$tag_ids)->groupBy('contact_id');
                return $query;
            });
        if (is_array($except_tag_ids) && count($except_tag_ids) > 0)
        {
            $new_except_contact_ids = ContactTag::where('tag_id',$except_tag_ids)->groupby('contact_id')->get()->pluck('contact_id')->toArray()??[];
//            dd($except_contact_ids,$new_except_contact_ids);
            $except_contact_ids =array_merge($except_contact_ids,$new_except_contact_ids);

        }
        $contact_ids = array_diff($contact_ids,$except_contact_ids);
        if (is_array($except_contact_ids) && count($except_contact_ids) > 0)
            $contacts->whereNotIn('id',$except_contact_ids);

        if (is_array($contact_ids) && count($contact_ids) > 0)
            $contacts = $contacts->orWhereIn('id',$contact_ids);
//        dd($contacts->toSql());

        if($request->state)
            $contacts->where('state',$request->state);

        $contacts = $contacts->get();
        if ($contacts->count() > 0)
        {
            $data=[];
            foreach ($contacts as $contact)
            {
                $reminder->setReceiverId($contact->id);
                $data[]= $this->reminderService->Send($reminder);
            }

            return $this->response($data,'success',200);
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
