<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getcities($id){
        if (ctype_digit($id))
            return json_encode(City::select('id','name')->where('province_id',$id)->get()->toarray());
        else
            return json_encode([]);

    }
    public function find(Request $request)
    {
        return Province::findbyname($request->q);
    }
}
