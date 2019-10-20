<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['user_id', 'personal_code', 'image', 'first_name'
        , 'last_name', 'mobile', 'email', 'tell', 'country', 'city', 'address'
        , 'location', 'post_code', 'national_code', 'type', 'state', 'created_by'
        , 'updated_by', 'deleted_on'];

}
