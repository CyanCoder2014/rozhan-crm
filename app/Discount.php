<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;

class Discount extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    const general_type= 0;
    const contacts_only_type = 1;
    const special_date_type = 2;

    const percent_amount_type = 0;
    const score_amount_type = 1;
    const money_amount_type = 2;


    const created_status = 0;
    const notified_status = 1;
    const reminded_status = 2;
    const reminder_set_status = 2;

    protected $fillable=[
        'title',
        'quantity',
        'type',
        'amount',
        'amount_type',
        'code',
        'start_at',
        'expired_at',
        'status',
        'created_by',
        'updated_by',
    ];

    /***************** relatiopns *********************/
    public function discountContacts(){
        return $this->hasMany(DiscountContact::class);
    }
    public function contacts(){
        return $this->hasManyThrough(Contact::class,DiscountContact::class,'discount_id','id','id','contact_id');
    }
    public function discountReferences(){
        return $this->hasMany(DiscountReference::class);
    }
    public function services(){
        return $this->morphedByMany(Service::class,'reference','discount_references');
    }
    public function products(){
        return $this->morphedByMany(Product::class,'reference','discount_references');
    }
    public function discountOrders(){
        return $this->hasMany(DiscountOrder::class);
    }
    public function orders(){
        return $this->hasManyThrough(Order::class,DiscountOrder::class,'discount_id','id','id','order_id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }

    /**************************************************/


    public function castDate(){
        $this->start_at = CalendarUtils::strftime('Y/m/d',strtotime($this->start_at));
        $this->expired_at = CalendarUtils::strftime('Y/m/d',strtotime($this->expired_at));
    }
    public function CanUse(User $user)
    {
        $status = 200;
        $message = '';
        if(Carbon::now()->lessThan($this->start_at) )
        {
            $status = 400 ;
            $message = 'زمان تخفیف هنوز نرسیده است';
            return compact('status','message');
        }
        if(Carbon::now()->greaterThan($this->expired_at) )
        {
            $status = 401 ;
            $message = 'زمان تخفیف به پایان رسیده است';
            return compact('status','message');
        }
        if ($this->type != self::general_type)
        {
            $discountContact = $this->discountContacts()->where('contact_id',$user->contact->id??null)->first();
            if (!$discountContact)
            {
                $status = 402 ;
                $message = 'این کاربر از این تخفیف برخوردار نیست';
                return compact('status','message');
            }

        }
        if ($this->orders()->where('state','!=',Order::cancel_state)->count() >= $this->quantity)
        {
            $status = 403 ;
            $message = 'این کاربر از تعداد سقف تخفبف استفاده کرده است';
            return compact('status','message');
        }
        return compact('status','message');

    }
    public function UsedBy(Order $order)
    {
        $status = 200;
        $message = '';

        if ($this->orders()->where('order_id',$order->id)->count() > 0)
        {
            $status = 404 ;
            $message = 'این سفارش از این تخفبف استفاده کرده است';
            return compact('status','message');
        }
        return compact('status','message');

    }
}
