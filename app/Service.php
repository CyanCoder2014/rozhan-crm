<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        'deleted_on'
    ];

    public function parent(){
        return $this->belongsTo(static::class);
    }


    public function serviceCategory(){
        return $this->belongsTo('App\ServiceCategory', 'service_categories_id');
    }

    public function persons(){
        return $this->hasManyThrough(Person::class,PersonService::class,'person_id','id','id','service_id');
    }


    public function priceCalculate(){
        if($this->price)
            return $this->price+($this->price*$this->tax/100);
        return 0;
    }
}
