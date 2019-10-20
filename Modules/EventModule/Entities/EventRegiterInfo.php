<?php

namespace Modules\EventModule\Entities;

use Illuminate\Database\Eloquent\Model;

class EventRegiterInfo extends Model
{
    const created_status = 0;
    protected $fillable = ['event_register_id','status','name','national_code'];

    public function EventRegister(){
        return $this->belongsTo(EventRegister::class);
    }
}
