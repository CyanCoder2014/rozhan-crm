<?php


namespace App\Repositories\Payment;


use App\Payment\CustomerPayment;

class CustomerPaymentRepository
{
    public function add($data)
    {
        $new = new CustomerPayment([
            'number'=>$data['number']??null,
            'reason'=>$data['reason']??null,
            'buyer'=>$data['buyer']??null,
            'receive_state'=>$data['receive_state']??null,
            'period'=>$data['period']??null,
            'pay_state'=>$data['pay_state']??null,
            'register_date'=>$data['register_date']??null,
            'due_date'=>$data['due_date']??null,
            'amount'=>$data['amount']??null,
            'account'=>$data['account']??null,
            'contract_number'=>$data['contract_number']??null,
            'bank'=>$data['bank']??null,
            'bank_calculate'=>$data['bank_calculate']??null,
            'cheque_number'=>$data['cheque_number']??null,
            'term'=>$data['term']??null,
            'payment_account'=>$data['payment_account']??null,
            'payed'=>$data['payed']??null,
            'type'=>$data['type']??null,
            'finance_state'=>$data['finance_state']??null,
            'description'=>$data['description']??null,
            'state'=>$data['state']??null,
            'status'=>$data['status']??null,
            'created_by'=>$data['created_by']??null,
            'updated_by'=>$data['updated_by']??null,
            'user_id'=>$data['user_id']??null,
            ]);
        $new->save();
        return ['data' =>$new,'message'=>'successful','status'=>200];
    }


}