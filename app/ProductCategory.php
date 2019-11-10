<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'product_id',
        'product_category_id',
        'title',
        'image',
        'description',
        'unit',
        'initial_amount',
        'remaining_number',
        'blocked_number',
        'price',
        'predicted_price',
        'tax',
        'star',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
    ];
}
