<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id',
        'service_categories_id',
        'title',
        'image',
        'description',
        'initial_number',
        'remaining_number',
        'blocked_number',
        'reserved',
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
        'deleted_at'
    ];

    public function parent(){
        return $this->belongsTo(static::class);
    }


    public function productCategory(){
        return $this->belongsTo('App\ProductCategory', 'product_categories_id');
    }


}
