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
        'deleted_at',
    ];

    ////////////////// relations //////////////////////////
    public function services(){
        return $this->hasMany(PersonService::class);
    }
    public function timing(){
        return $this->hasMany(PersonTiming::class);
    }
    public function OrderServices(){
        return $this->hasMany(OrderService::class);
    }
    public function Orders(){
        return $this->hasManyThrough(Order::class,OrderService::class,'person_id','id','id','order_id');
    }
    public function serviceFeedback(){
        return $this->hasManyThrough(OrderServiceFeedback::class,OrderService::class,'person_id','order_service_id','id','id');
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
                ->count() == 0)
            return false;
        if ($this->OrderServices()->where('date', $date)
                ->where(function ($query) use ($start_at,$end_at){
                    return $query->where(function ($query) use ($start_at){
                        return $query->where('start','<=', $start_at)
                            ->where('end','>', $start_at);
                    })
                        ->orWhere(function ($query) use ($end_at){
                            return $query->where('start','<', $end_at)
                                ->where('end','>=', $end_at);
                        });
                })
                ->count() > 0)
            return false;
        return true;

    }
    public function dateTimeSchedule($date){
        $available = $this->timing()
            ->whereNotNull('start')->whereNotNull('end')
            ->where('date', $date)->select(['start','end'])->get()->toArray();
        $booked =   $this->OrderServices()
            ->whereNotNull('start')->whereNotNull('end')
            ->where('date', $date)->select(['start','end'])->get()->toArray();
        return compact('available','booked');

    }
    public function availableTime($date){
        $available = $this->timing()
            ->whereNotNull('start')->whereNotNull('end')
            ->where('date', $date)->select(['start','end'])->get();
        if ($available->count() == 0)
            return [];
        $out=[];
        $booked =   $this->OrderServices()
            ->whereNotNull('start')->whereNotNull('end')
            ->where('date', $date)->select(['start','end'])->get();
        foreach ($available as $availbaletime){
            $startInt = strTimeToInt($availbaletime->start);
            $endInt = strTimeToInt($availbaletime->end);
            foreach ($booked as $bookTime){
                $startBookInt = strTimeToInt($bookTime->start);
                $endBookInt = strTimeToInt($bookTime->end);
                if ($startInt <= $startBookInt && $startBookInt < $endInt
                && $startInt < $endBookInt && $endBookInt <= $endInt)
                {
                    if ($startInt < $startBookInt)
                    $out[]= [
                      'start' =>  IntToTime($startInt),
                      'end' =>  IntToTime($startBookInt),
                    ];
                    $startInt = $endBookInt;
                }
            }
            if ($startInt < $endInt)
                $out[]= [
                    'start' =>  IntToTime($startInt),
                    'end' =>  IntToTime($endInt),
                ];

        }
        return $out;

    }

    /**
     * get availabe times that can do the service
     * @param $date
     * @param Service $service
     * @return array
     *
     */
    public function availableTimeService($date,Service $service)
    {
        $AvailableTimes = $this->availableTime($date);
        foreach ($AvailableTimes as $key => $time)
            if (((strTimeToInt($time['end']) - strTimeToInt($time['start']))/60) < $service->max_time) // can do the service in this available time
                unset($AvailableTimes[$key]);
        return $AvailableTimes;

    }

    public function updateRate(){
        $this->star = $this->serviceFeedback()->avg('rate');
        return $this;
    }

}
