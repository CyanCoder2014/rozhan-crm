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
}
