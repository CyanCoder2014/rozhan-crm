<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{

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
        'state',
        'created_by',
        'updated_by',
        'deleted_on',

    ];
}
