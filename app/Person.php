<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table='persons';

    protected $fillable=[
        'user_id',
        'name',
        'image',
        'family',
        'description',
        'min_time',
        'score',
        'star',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_on',
    ];

    ////////////////// relations //////////////////////////
    public function services(){
        return $this->hasMany(PersonService::class);
    }
    public function timing(){
        return $this->hasMany(PersonTiming::class);
    }
    ///////////////////////////////////////////////////////
    public function hasService(Service $service):bool{
        if ($this->services()->where('service_id', $service->id)->count() > 0)
            return true;
        return false;

    }

    public function isAvailabe($date ,$start_at,$end_at){
        if ($this->timing()->where('date', $date)
                ->where('start','<=', $start_at)
                ->where('end','>=', $end_at)
                ->count() > 0)
            return true;
        return false;

    }
}
