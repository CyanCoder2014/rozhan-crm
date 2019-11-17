<?php


namespace App\Services\ReminderService\ReminderRepository;


use App\Reminder;

class ReminderRepository
{
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

}