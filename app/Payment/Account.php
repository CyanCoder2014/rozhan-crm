<?php

namespace App\Payment;

use App\CooperationAccount;
use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable = [
        'title',
        'name',
        'number',
        'details',
        'debt',
        'credit',
        'collecting_balance',
        'balance',
        'bank',
        'sheba',
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
