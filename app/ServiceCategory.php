<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'image',
        'description',
        'number',
        'star',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_on',
    ];
}
