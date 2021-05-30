<?php

namespace App\Payment;

use App\CooperationAccount;
use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'number',
        'reason',
        'buyer',
        'recipient',
        'recipient_code',
        'recipient_name',
        'period',
        'pay_state',
        'register_date',
        'due_date',
        'amount',
        'account',
        'contract_number',
        'bank',
        'bank_calculate',
        'cheque_number',
        'term',
        'receiver_account',
        'payed',
        'type',
        'description',
        'state',
        'status',
        'created_by',
        'updated_by',
    ];


    public function account(){
        return $this->belongsTo('App\Payment\Account', 'account');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
