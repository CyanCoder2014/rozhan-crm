<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'parent_id',
        'service_categories_id',
        'title',
        'image',
        'description',
        'initial_number',
        'remaining_number',
        'blocked_number',
        'reserved',
        'price',
        'predicted_price',
        'default_discount',
        'tax',
        'min_time',
        'max_time',
        'type',
        'star',
        'state',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    public function parent(){
        return $this->belongsTo(static::class);
    }


    public function serviceCategory(){
        return $this->belongsTo('App\ServiceCategory', 'service_categories_id');
    }

    public function persons(){
        return $this->hasManyThrough(Person::class,PersonService::class,'service_id','id','id','person_id');
    }


    public function priceCalculate(){
        if($this->price)
            return $this->price+($this->price*$this->tax/100);
        return 0;
    }

    public function highestScoreAvailablePerson(Carbon $dateTime){
        foreach ($this->persons->sortByDesc('score') as $person){
            $availabeTimes = $person->availableTimeService($dateTime->format('Y-m-d'),$this);
            foreach ($availabeTimes as $availabeTime)
            {
                $timeArray = explode(':',$availabeTime['start']);
                $availableDateTime = $dateTime->clone()->setTime($timeArray[0]??0,$timeArray[1]??0);
                if ($dateTime->lessThanOrEqualTo($availableDateTime)){
                    $person->availableTime = $availabeTime;
                    return $person;
                }
            }
        }
        return null;
    }
}
