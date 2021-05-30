<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class ServiceDiscount extends Model
{
    use CooperationAccountTrait;

    protected $fillable =[
        'discount_id',
        'service_id',
        'created_by',
        'updated_by',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
