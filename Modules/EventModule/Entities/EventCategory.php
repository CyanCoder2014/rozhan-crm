<?php

namespace Modules\EventModule\Entities;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ['name','description'];
}
