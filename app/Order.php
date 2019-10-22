<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const created_status = 0;

    protected $fillable=[
        'user_id',
        'title',
        'description',
        'file',
        'general_price',
        'general_discount',
        'general_tax',
        'final_price',
        'general_date',
        'general_start',
        'general_end',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_on',
    ];

    public function is_editable(){
        return true;
    }
}