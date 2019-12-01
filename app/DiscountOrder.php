<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountOrder extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'discount_id',
        'order_id'
    ];
}
