<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialDate extends Model
{
    use SoftDeletes;
    protected $fillable =[
        'contact_id',
        'title',
        'special_date',
        'percent',
        'type',
        'state',
        'created_by',
        'updated_by',
        'discount_id'
    ];

    /************* relations *************/
    public function contact(){
        return $this->belongsTo(Contact::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
    /*************************************/
}
