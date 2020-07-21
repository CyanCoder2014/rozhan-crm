<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;



    const created_state = 0;
    const payed_state = 2;
    const complete_state = 3;
    const cancel_state = 1;
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
