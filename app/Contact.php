<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;
    protected $fillable = ['user_id', 'personal_code', 'image', 'first_name'
        , 'last_name', 'mobile', 'email', 'tell', 'country', 'city', 'address'
        , 'location', 'post_code', 'national_code', 'type', 'state', 'created_by'
        , 'updated_by', 'deleted_on'];

    public function routeNotificationForSms($notification)
    {
        return $this->mobile;
    }
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

}
