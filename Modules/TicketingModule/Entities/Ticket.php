<?php

namespace Modules\TicketingModule\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    const waiting_status = 0;
    const answered_status = 1;
    const done_status = 2;
    const blocked_status = 3;
    protected $fillable = ['owner_id','answerable_id','category_id','active','status'];

    public function owner(){
        return $this->belongsTo(User::class);
    }
    public function answerable(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(TicketCategory::class);
    }
    public function messages(){
        return $this->hasMany(TicketMessage::class);
    }
}
