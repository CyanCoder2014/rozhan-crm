<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable=[
                        "messageid" ,
                        "message",
                        "status",
                        "statustext",
                        "sender",
                        "receptor",
                        "date" ,
                        "cost",
                        "user_id"
    ];
}
