<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;
    const general_type= 0;
    const contacts_only_type = 1;

    const percent_amount_type = 0;
    const score_amount_type = 1;
    const money_amount_type = 2;

    protected $fillable=[
        'title',
        'quantity',
        'type',
        'amount',
        'amount_type',
        'code',
        'start_at',
        'expired_at',
        'status',
        'created_by',
        'updated_by',
    ];

    /***************** relatiopns *********************/
    public function discountContacts(){
        return $this->hasMany(DiscountContact::class);
    }
    public function contacts(){
        return $this->hasManyThrough(Contact::class,DiscountContact::class,'discount_id','id','id','contact_id');
    }
    public function discountReferences(){
        return $this->hasMany(DiscountReference::class);
    }
    public function services(){
        return $this->morphedByMany(Service::class,'reference','discount_references');
    }
    public function products(){
        return $this->morphedByMany(Product::class,'reference','discount_references');
    }

    /**************************************************/


    public function castDate(){
        $this->start_at = to_jalali($this->start_at);
        $this->expired_at = to_jalali($this->expired_at);
    }

}
