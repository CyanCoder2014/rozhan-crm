<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    protected $fillable=[
        'name',
        'message',
        'token',
        'token2',
        'token3',
        'token10',
        'token20',
        'state',
    ];
}
