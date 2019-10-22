<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonService extends Model
{

    protected $fillable=[
        'person_id',
        'service_id',
        'title',
        'note',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_on',
    ];
}