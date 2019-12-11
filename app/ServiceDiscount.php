<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDiscount extends Model
{
    protected $fillable =[
        'discount_id',
        'service_id',
        'created_by',
        'updated_by',
    ];
}
