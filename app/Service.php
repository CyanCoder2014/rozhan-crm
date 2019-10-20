<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'address', 'website', 'email'];

    public $timestamps = false;
}
