<?php


namespace App\Services\ReminderService\ReminderRepository;


use App\Reminder;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ReminderRepository
{
    public function paginate($perPage=15){
        return Reminder::paginate($perPage);
    }
    public function add($data){
        return Reminder::create([
            'parent_id'=>$data['parent_id']??null,
            'title'=>$data['title'],
            'description'=>$data['description'],
            'receiver_type'=>$data['receiver_type'],
            'receiver_id'=>$data['receiver_id'],
            'sender_type'=>$data['sender_type'],
            'sender_id'=>$data['sender_id'],
            'state'=>$data['state']??0,
            'status'=>$data['status']??0,
            'reminder_at'=>$data['reminder_at'],
            'execute_at'=>$data['execute_at'],
            'notify_type'=>$data['notify_type'],
            'created_by'=>$data['created_by'],
        ])->toArray();
    }
    public function edit($data){
        return Reminder::update([
            'parent_id'=>$data['parent_id']??null,
            'title'=>$data['title'],
            'description'=>$data['description'],
            'receiver_type'=>$data['receiver_type'],
            'receiver_id'=>$data['receiver_id'],
            'sender_type'=>$data['sender_type'],
            'sender_id'=>$data['sender_id'],
            'state'=>$data['state'],
            'status'=>$data['status'],
            'reminder_at'=>$data['reminder_at'],
            'execute_at'=>$data['execute_at'],
            'notify_type'=>$data['notify_type'],
            'updated_by'=>$data['updated_by'],
        ])->where('id',$data['id'])->toArray();
    }
    public function find($id){
        $raw = Reminder::find($id);
        if ($raw)
            return $raw->toArray();
        return [];
    }
    public function destroy($id){
        $raw = Reminder::destroy([$id]);
    }

    public function UsersReminder(array $user_ids,$date_from=null,$date_to=null)
    {
        $reminder = Reminder::where('receiver_type',User::class)->whereIn('receiver_id',$user_ids);
        if ($date_from)
            $reminder->where('reminder_at','>=',$date_from.' 00:00:00');
        if ($date_to)
            $reminder->where('reminder_at','<=',$date_to.' 23:59:59');
        return $reminder->get()->groupBy('receiver_id');

    }
    public function clientsReminder($date_from=null,$date_to=null)
    {
        $reminder = User::with('reminders')->whereHas('contact')
            ->whereHas('reminders',function ($query) use($date_from,$date_to){
            if ($date_from)
                $query->where('reminder_at','>=',$date_from.' 00:00:00');
            if ($date_to)
                $query->where('reminder_at','<=',$date_to.' 23:59:59');
        });
        return $reminder->get();

    }
    public function personnelsReminder($date_from=null,$date_to=null)
    {
        $reminder = User::with('reminders')->whereHas('person')
            ->whereHas('reminders',function ($query) use($date_from,$date_to){
            if ($date_from)
                $query->where('reminder_at','>=',$date_from.' 00:00:00');
            if ($date_to)
                $query->where('reminder_at','<=',$date_to.' 23:59:59');
        });
        return $reminder->get();

    }
    public function UserReminder($user_id,$date_from=null,$date_to=null)
    {

        $reminder = Reminder::where('receiver_type',User::class)->where('receiver_id',$user_id);
        if ($date_from)
            $reminder->where('reminder_at','>=',$date_from.' 00:00:00');
        if ($date_to)
            $reminder->where('reminder_at','<=',$date_to.' 23:59:59');
//        dd($reminder->toSql(),$date_from.' 00:00:00',$date_to.' 23:59:59');

        return $reminder->get();

    }

}