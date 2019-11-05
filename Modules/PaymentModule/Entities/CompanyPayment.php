<?php

namespace Modules\PaymentModule\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    protected $fillable=[
        'id',
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
        'created_at',
        'updated_at',
    ];
}
