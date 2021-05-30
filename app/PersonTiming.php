<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class PersonTiming extends Model
{
    use CooperationAccountTrait;

    protected $fillable=[
        'person_id',
        'title',
        'description',
        'date',
        'start',
        'end',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
    ];


    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
