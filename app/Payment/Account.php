<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
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
}
