<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'note',
        'unit',
        'amount',
        'price',
        'discount',
        'tax',
        'date',
        'start',
        'end',
        'type',
        'state',
        'created_by',
        'updated_by',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
