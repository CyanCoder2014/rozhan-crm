<?php

namespace Modules\TicketingModule\Entities;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = ['name','description'];
}
