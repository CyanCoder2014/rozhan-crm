<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTag extends Model
{
    protected $fillable=['tag_id','contact_id'];
}
