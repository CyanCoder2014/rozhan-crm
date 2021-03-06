<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class OrderServiceFeedback extends Model
{
    use CooperationAccountTrait;

    const created_state = 0;
    const accepted_state = 1;
    protected $fillable=[
        'user_id',
        'order_service_id',
        'rate',
        'comment',
        'state',
        'created_by',
        'updated_by',
    ];

    public function person(){
        return $this->hasOneThrough(Person::class,OrderService::class,'person_id','id','order_service_id','id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
