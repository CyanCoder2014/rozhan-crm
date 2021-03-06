<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable=[
        'contact_id',
        'age',
        'major',
        'education_field',
        'work_field',
        'national_code',
        'gender',
        'birth',
        'about',
        'visitor_note',
        'type',
        'state',

        'regent',
        'reagent_detail',
        'reagent_state',
        'reagent_page',
        'reagent_site',
        'reagent_type',
        'regent_id',

        'weight',
        'height',

        'disease',
        'drug',
        'heart',
        'respiratory',
        'Liver',
        'Diabetes',
        'Seizure',
        'infectiousdisease',
        'tumor',
        'asthma',
        'hormonaldisorder',
        'otherHerpes',
        'asprin',
        'deyper',
        'convulsion',
        'arpharin',
        'heparin',
        'minoxide',
        'rakuten',
        'cream',
        'otherpharmacy',
        'boronz',
        'surgery',
        'typeSurgery',
        'getpregnant',
        'milch',
        'Botox',
        'zhel',


        'Kidney',
        'thyroid',
        'hormonal',
        'allergy',
        'Laser',




        'text',  // used as profile code and detail

    ];



    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
