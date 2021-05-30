<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use CooperationAccountTrait;

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
