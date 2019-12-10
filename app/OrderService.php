<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    const created_state = 0;
    const payed_state = 2;
    const complete_state = 3;
    const cancel_state = 1;

    const quick_type = 0;

    protected $fillable=[
        'order_id',
        'service_id',
        'person_id',
        'note',
        'number',
        'price',
        'discount',
        'tax',
        'date',
        'start',
        'type',
        'end',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',

    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }
    public function user(){
        return $this->hasOneThrough(User::class,Order::class,'id','user_id','order_id','id');
    }
    public function contact(){
        return $this->hasOneThrough(Contact::class,Order::class,'id','user_id','order_id','user_id');
    }
    public function hasConflictWith(OrderService $service):bool{
        if ($this->date != $service->date)
            false;
        if (strtotime($this->start) <= strtotime($service->start) && strtotime($this->end) > strtotime($service->start))
            return true;
        if (strtotime($this->start) < strtotime($service->end) && strtotime($this->end) >= strtotime($service->end))
            return true;
        return false;
    }

}
