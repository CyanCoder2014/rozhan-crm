<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialDateRequest;
use App\SpecialDate;
use Illuminate\Http\Request;

class SpecialDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contact_id)
    {
        return SpecialDate::with('discount')->where('contact_id',$contact_id)->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialDateRequest $request,$contact_id)
    {
        $new = new SpecialDate();
        $new->fill($request->casts());
        $new->created_by = auth()->id();
        $new->contact_id = $contact_id;
        $new->save();
        return $this->response($new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function show($contact_id,SpecialDate $specialDate)
    {
        $specialDate->discount;
        $specialDate->special_date = to_jalali_date($specialDate->special_date);
        return $this->response($specialDate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function edit($contact_id,SpecialDate $specialDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialDateRequest $request,$contact_id, SpecialDate $specialDate)
    {
        if ($specialDate->contact_id != $contact_id)
            abort(404);
        $specialDate->fill($request->casts());
        $specialDate->updated_by = auth()->id();
        $specialDate->save();
        return $this->response($specialDate);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id,SpecialDate $specialDate)
    {
        if ($specialDate->contact_id != $contact_id)
            abort(404);
        $specialDate->delete();
        return $this->response($specialDate);

    }
}
