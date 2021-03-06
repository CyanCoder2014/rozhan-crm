<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGift extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable =[
        'user_id',
        'score_gift_id',
        'used_order_id',
        'created_by',
        'updated_by',
    ];
    public function scopeNotUsed($query)
    {
        return $query->whereNull('used_order_id');
    }
    public static function NotUsed()
    {
        return static::whereNull('used_order_id');
    }
    public function isUsed():bool
    {
        if ($this->used_order_id)
            return true;
        return false;
    }
    /**************** relations ************/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'used_order_id');
    }
    public function scoreGift()
    {
        return $this->belongsTo(ScoreGifts::class);
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }

    /***************************************/
}
