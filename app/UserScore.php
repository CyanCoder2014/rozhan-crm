<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $fillable=[
        'score',
        'user_id' ,
        'reference_type',
        'reference_id' ,
        'description',
        'created_by' ,
    ];
}
