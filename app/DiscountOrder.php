<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountOrder extends Model
{
    protected $fillable=[
        'discount_id',
        'order_id'
    ];
}
