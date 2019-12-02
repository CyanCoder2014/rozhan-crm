<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
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

}
