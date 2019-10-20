<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function find(Request $request)
    {
        return City::findbyname($request->q);
    }
}
