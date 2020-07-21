<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{


    use SoftDeletes;


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
