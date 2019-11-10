<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = [
        'number',
        'reason',
        'buyer',
        'receive_state',
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
        'payment_account',
        'payed',
        'type',
        'finance_state',
        'description',
        'state',
        'status',
        'created_by',
        'updated_by',
    ];
}
