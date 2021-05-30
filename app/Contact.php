<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{

    use SoftDeletes;
    use CooperationAccountTrait;



    use Notifiable;
    protected $fillable = ['user_id', 'personal_code', 'image', 'first_name'
        , 'last_name', 'mobile', 'email', 'tell', 'country', 'city', 'address'
        , 'location', 'post_code', 'national_code', 'type', 'state', 'created_by'
        , 'updated_by', 'deleted_at', 'group_id'];

    public function routeNotificationForSms($notification)
    {
        return $this->mobile;
    }
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function getContactName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getContactCode()
    {
        return $this->personal_code;
    }





    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->hasManyThrough(CTag::class,ContactTag::class,'contact_id','id','id','tag_id');
    }
    public function ConatctTags(){
        return $this->hasMany(ContactTag::class);
    }
    public function group()
    {
        return $this->belongsTo(ContactGroup::class);
    }
    public function reviews()
    {
        return $this->hasMany(ContactReview::class);
    }

    public function userProfile(){
        return $this->hasMany(UserProfile::class, 'contact_id');
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
