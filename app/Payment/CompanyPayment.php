<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPayment extends Model
{


//    use SoftDeletes;


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
}
