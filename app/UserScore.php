<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'score',
        'user_id' ,
        'reference_type',
        'reference_id' ,
        'description',
        'created_by' ,
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
