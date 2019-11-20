<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const created_state = 0;
    const payed_state = 2;
    const complete_state = 3;

    const cancel_state = 0;

    const quick_type = 1;

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
        'deleted_at',
    ];

    public function is_editable(){
        return true;
    }


    public function OrderServices(){
        return $this->hasMany(OrderService::class);
    }
    public function OrderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function CanClientEdit(): bool {
        return true;
    }
    public function CanClientCancel(): bool {
        return true;
    }
}
