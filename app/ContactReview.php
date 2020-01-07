<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactReview extends Model
{
    protected $fillable=[
        'contact_id',
        'person_id',
        'rate',
        'comment',
        'state',
        'created_by',
        'updated_by',
    ];

    /***************** relations ********************/
    public function contact()
    {
//        return $this->belongsTo(Contact::class);
        return $this->belongsTo('App\Contact', 'contact_id');

    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    /************************************************/
}
