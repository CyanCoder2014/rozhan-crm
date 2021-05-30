<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class PersonService extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'person_id',
        'service_id',
        'title',
        'note',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function personTiming(){
        return $this->hasMany(PersonTiming::class,'person_id','person_id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
