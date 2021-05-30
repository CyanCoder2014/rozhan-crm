<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'name',
        'message',
        'token',
        'token2',
        'token3',
        'token10',
        'token20',
        'state',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
