<?php

namespace App\Payment;

use App\CooperationAccount;
use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class BuyFactor extends Model
{
    use CooperationAccountTrait;

    protected $fillable = [
        'product_code',
        'product_name',
        'product_description',
        'numbers',
        'unit',
        'unit_price',
        'discount',
        'final_price',
        'factor_date',
        'tax',
        'price_plus_tax',
        'account_id',
        'buy_type',
        'description',
        'full_name',
        'national_code',
        'register_number',
        'address',
        'post_code',
        'tell_number',
        'economic_code',
        'state',
        'status',
        'created_by',
        'updated_by',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
