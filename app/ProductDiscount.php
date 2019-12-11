<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    protected $fillable =[
        'discount_id',
        'product_id',
        'created_by',
        'updated_by',
    ];
}
