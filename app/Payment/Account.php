<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{

    use SoftDeletes;


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
