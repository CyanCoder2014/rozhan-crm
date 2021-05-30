<?php

namespace App;

use App\Scopes\CooperationAccountScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

//    use SoftDeletes;


    use LaratrustUserTrait;
    use Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CooperationAccountScope());

        static::creating(function ($model) {
            if (Auth::id()) {
                $model->co_account_id = Auth::user()->co_account_id;
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */




    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $roles = $this->roles()->get()->pluck('name')->all();
        $permissions = $this->permissions()->get()->pluck('name')->all();

        return [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $roles,
            'permissions' => $permissions,
        ];
    }
    public function isAdmin(){
        if ($this->roles()->count() > 0)
            return true;
        return false;
    }
    /****************** relations **************/
    public function orders(){
        return $this->hasMany(Order::class)->orderBy('created_at', 'desc');
    }
    public function contact(){
        return $this->hasOne(Contact::class);
    }
    public function person(){
        return $this->hasOne(Person::class);
    }
    public function reminders()
    {
        return $this->morphMany(Reminder::class,'receiver');
    }

    public function specialDates()
    {
        return $this->hasManyThrough(SpecialDate::class,Contact::class,'user_id','contact_id','id','id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }

    /*******************************************/

    public function routeNotificationForSms($notification)
    {
        return $this->mobile;
    }
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
