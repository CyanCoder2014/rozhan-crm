<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function timing(){
        return $this->hasMany(PersonTiming::class);
    }
    public function OrderServices(){
        return $this->hasMany(OrderService::class);
    }
    public function TrueOrderServices(){
        return $this->OrderServices()->where('state','!=',OrderService::cancel_state);
    }
    public function Orders(){
        return $this->hasManyThrough(Order::class,OrderService::class,'person_id','id','id','order_id');
    }
    public function serviceFeedback(){
        return $this->hasManyThrough(OrderServiceFeedback::class,OrderService::class,'person_id','order_service_id','id','id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
    ///////////////////////////////////////////////////////
    public function hasService(Service $service):bool{
        if ($this->services()->where('service_id', $service->id)->count() > 0)
            return true;
        return false;

    }

    public function CustomerContactIds()
    {
        return $this->Orders()->select('orders.user_id','contacts.id')
                ->where('orders.state','!=',Order::cancel_state)
                ->groupBy('user_id')
                ->join('contacts','contacts.user_id','=','orders.user_id')
                ->get()->pluck('id')->toArray();
    }
    public function isAvailabe($date ,$start_at,$end_at){
        if ($this->timing()->where('date', $date)
                ->where('start','<=', $start_at)
                ->where('end','>=', $end_at)
                ->count() == 0)
            return false;
        if ($this->TrueOrderServices()->where('date', $date)
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
        $booked =   $this->TrueOrderServices()
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
        $booked =   $this->TrueOrderServices()
            ->whereNotNull('start')->whereNotNull('end')
            ->where('date', $date)->select(['start','end'])->orderBy('start')->get();
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
