<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    const notify_types =[
      'db' => 1,
      'email' => 2,
      'db+email' => 3,
      'sms' => 4,
      'sms+db' => 5,
      'sms+email' => 6,
      'sms+email+db' => 7,
    ];
    protected $fillable =[
        'parent_id',
        'title',
        'description',
        'reference_type',
        'reference_id',
        'state',
        'status',
        'reminder_at',
        'execute_at',
        'notify_type',
        'created_by',
        'updated_by'

    ];
}
