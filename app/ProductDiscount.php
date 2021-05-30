<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use CooperationAccountTrait;

    protected $fillable =[
        'discount_id',
        'product_id',
        'created_by',
        'updated_by',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
