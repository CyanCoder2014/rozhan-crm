<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountReference extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'discount_id',
        'reference_id',
        'reference_type'
    ];
}
