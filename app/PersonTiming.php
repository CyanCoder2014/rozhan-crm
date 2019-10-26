<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonTiming extends Model
{
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
        'deleted_on',
    ];
}
