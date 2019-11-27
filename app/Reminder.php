<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    const notify_types =[
      'db' => 1,
      'email' => 2,
      'db+email' => 3,
      'sms' => 4,
      'sms+db' => 5,
      'sms+email' => 6,
      'sms+email+db' => 7,
    ];
    const created_status = 0;
    const executed_status = 1;
    const canceled_status = 2;
    protected $fillable =[
        'parent_id',
        'title',
        'description',
        'receiver_type',
        'receiver_id',
        'sender_type',
        'sender_id',
        'state',
        'status',
        'reminder_at',
        'execute_at',
        'notify_type',
        'created_by',
        'updated_by'

    ];


    public function getNotifyType(){
        $notify = $this->notify_type;
        $out=[];
        if ($notify >= 4){
            $notify-=4;
            $out[] = 'sms';
        }
        if ($notify >= 2){
            $notify-=2;
            $out[] = 'email';
        }
        if ($notify >= 1){
            $out[] = 'db';
        }
        return $out;
    }

    public function receiver(){
        return $this->morphTo();
    }
    public function sender(){
        return $this->morphTo();
    }
}
