<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    const created_status = 0;

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
        'end',
        'state',
        'created_by',
        'updated_by',
        'deleted_on',

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
}
