<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable=[
        'contact_id',
        'age',
        'major',
        'education_field',
        'work_field',
        'national_code',
        'gender',
        'birth',
        'about',
        'visitor_note',
        'type',
        'state',
    ];
}
