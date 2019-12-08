<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreGifts extends Model
{
    protected $fillable=[
        'title',
        'score',
        'reference_type',
        'reference_id',
        'created_by',
        'updated_by',
    ];

    public function reference()
    {
        return $this->morphTo();
    }
}
