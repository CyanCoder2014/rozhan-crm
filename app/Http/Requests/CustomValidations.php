<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Validator;

trait CustomValidations
{
    public function sameEmail()
    {
        Validator::extend('sameEmail', function ($attribute, $value, $data) {
            return $value === $data[0];
        });
    }
}
