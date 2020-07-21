<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPayment extends Model
{


//    use SoftDeletes;


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
        'user_id',

        'contact_id',
        'order_id',
    ];



    public function account(){
        return $this->belongsTo('App\Payment\Account', 'account');
    }

    public function contact(){
        return $this->belongsTo('App\Contact', 'contact_id');
    }

}
