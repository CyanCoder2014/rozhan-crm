<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountContact extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'discount_id',
        'contact_id',
    ];
}
