<?php

namespace App\Http\Controllers;

use App\Http\Requests\workCalendarRequest;
use App\Person;
use Illuminate\Http\Request;

class workCalendarController extends Controller
{
    public function index(workCalendarRequest $request){

        $query =  Person::with(['timing','OrderServices']);
        if (is_array($request->person_ids))
            $query->whereIn('id',$request->person_ids);
        if ($request->date_to){
            return $query->whereHas('timing',function ($query) use($request){
                $query->whereBetween('date', [to_georgian_date($request->date_from),to_georgian_date($request->date_to)]);
            })->get();
        }
        else
            return $query->whereHas('timing',function ($query) use($request){
                $query->where('date', to_georgian_date($request->date_from));
            })->get();

    }
}