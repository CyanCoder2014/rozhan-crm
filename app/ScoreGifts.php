<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class ScoreGifts extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'title',
        'score',
        'reference_type',
        'reference_id',
        'created_by',
        'updated_by',
    ];

    public function reference()
    {
        return $this->morphTo();
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
