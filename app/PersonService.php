<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonService extends Model
{


//    use SoftDeletes;



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
}
