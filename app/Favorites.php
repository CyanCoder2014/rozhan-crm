<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'contact_id',
        'title',
        'description',
        'number',
        'percent',
        'type',
        'state',
        'created_by',
        'updated_by',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
