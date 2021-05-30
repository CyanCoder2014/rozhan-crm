<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class VacationDate extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'date',
        'title',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
