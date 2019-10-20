<?php

namespace Modules\TicketingModule\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    const waiting_status = 0;
    const answer_status = 1;
    protected $fillable = ['owner_id','title','description','title','description','ticket_id','status','reply_to'];

    public function owner(){
        return $this->belongsTo(User::class);
    }
    public function reply(){
        return $this->belongsTo(static::class,'reply_to');
    }
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
