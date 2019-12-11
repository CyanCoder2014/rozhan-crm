<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const created_state = 0;
    const payed_state = 2;
    const complete_state = 3;
    const cancel_state = 1;

    const state_diagram=[
      self::created_state =>[
          self::payed_state =>true,
          self::cancel_state =>true
      ] ,
      self::payed_state =>[
          self::cancel_state =>true,
          self::complete_state =>true
      ]
    ];


    const quick_type = 1;

    protected $fillable=[
        'user_id',
        'title',
        'description',
        'file',
        'general_price',
        'general_discount',
        'general_tax',
        'final_price',
        'general_date',
        'general_start',
        'general_end',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function is_editable(){
        return true;
    }

    /******************* Relations ***********************/
    public function OrderServices(){
        return $this->hasMany(OrderService::class);
    }
    public function OrderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
    public function services(){
        return $this->hasManyThrough(Service::class,OrderService::class,'order_id','id','id','service_id');
    }
    public function products(){
        return $this->hasManyThrough(Product::class,OrderProduct::class,'order_id','id','id','product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function contact(){
        return $this->hasOne(contact::class,'user_id','user_id');
    }

    public function discount(){
        return $this->hasManyThrough(Discount::class,DiscountOrder::class,'order_id','id','id','discount_id');
    }
    /*****************************************************/
    public function CanClientEdit(): bool {
        return true;
    }
    public function CanClientCancel(): bool {
        return true;
    }

    public static function canChangeState($from,$to)
    {
        if (isset(static::state_diagram[$from][$to]) and static::state_diagram[$from][$to])
            return true;
        return false;
    }

}
