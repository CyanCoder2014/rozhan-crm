<?php

namespace Modules\EventModule\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventRegister extends Model
{
    const created_status = 0;
    const payment_status = 1;
    const payed_status = 2;
    const payment_canceled_status = 3;
    const success_status = 4;

    const statusAlias=[
      0 => 'پیش ثبت نام',
      1 => 'درحال پرداخت',
      2 => 'پرداخت شده',
      3 => 'لغو پرداخت',
      4 => 'ثبت نام کامل',
    ];

    protected $fillable = ['user_id','event_id','status','quantity','price','payment_id','tracking_code'];

    public static function CreateTrickingCode(){
        while (true){
            $tracking_code = Str::random(12);
            if (! static::where('tracking_code',$tracking_code)->first())
                return $tracking_code;

        }

    }

    public function infos(){
        return $this->hasMany(EventRegiterInfo::class);
    }

    public function statusAlias(){
        return static::statusAlias[$this->status]??'نامعلوم';
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }



}
