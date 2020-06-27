<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
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



}
