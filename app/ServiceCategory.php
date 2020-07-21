<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{

    use SoftDeletes;


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
        'deleted_at',
    ];
}
