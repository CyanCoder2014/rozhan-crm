<?php

namespace Modules\EventModule\Entities;

use App\City;
use App\Province;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'image',
        'category_id',
        'capacity',
        'price',
        'quantity_limit',
        'province_id',
        'city_id',
        'address',
        'lat',
        'lng',
        'event_start_at',
        'event_end_at',
        'start_registration',
        'end_registration',
        'status',
        ];

    const statusAlias=[
        0 => 'غیرفعال',
        1 => 'فعال',
    ];

    public function category(){
        return $this->belongsTo(EventCategory::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function Registered(){
        return $this->hasMany(EventRegister::class);
    }
    public function SuccessRegistered(){
        return $this->Registered()->where('status',EventRegister::success_status);
    }
    public function residualCapacity(){
        return $this->capacity - $this->SuccessRegistered->sum('quantity');
    }

    public function statusAlias(){
        return static::statusAlias[$this->status]??'نامعلوم';
    }
    public function registerable() : bool{
        return (
            Carbon::now()->gt($this->end_registration) &&
            Carbon::now()->lt($this->start_registration) &&
            $this->status == 0 &&
            $this->residualCapacity() <= 0
        );
    }
}
