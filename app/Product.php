<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_id',
        'product_category_id',
        'title',
        'image',
        'description',
        'initial_amount',
        'remaining_number',
        'blocked_number',
        'price',
        'predicted_price',
        'default_discount',
        'tax',
        'min_time',
        'max_time',
        'type',
        'star',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
        'score',

    ];

    public function parent(){
        return $this->belongsTo(static::class);
    }


    public function productCategory(){
        return $this->belongsTo('App\ProductCategory', 'product_category_id');
    }

    public function priceCalculate()
    {
        return $this->price;
    }
    public function OrderProducts(){
        return $this->hasMany(OrderProduct::class,'product_id');
    }


    public function isAmountAvailable(int $amount)
    {
        if (!isset($this->remaining_number) or ($this->remaining_number - $this->notAvailable()->sum('amount')) < $amount)
            return false;
        return true;
    }
    public function notAvailable()
    {
        return $this->OrderProducts()->where('state','!=',OrderProduct::cancel_state);
    }
    public function Buyed()
    {
        return $this->OrderProducts()->whereIn('state',[OrderProduct::complete_state,OrderProduct::payed_state]);
    }


}
