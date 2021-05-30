<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactReview extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable=[
        'contact_id',
        'person_id',
        'rate',
        'comment',
        'state',
        'image',
        'created_by',
        'updated_by',
        'order_id',
    ];

    /***************** relations ********************/
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
    /************************************************/
}
