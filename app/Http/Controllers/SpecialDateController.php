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
    public function index()
    {
        return SpecialDate::with('contact','discount')->paginate();
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
    public function store(SpecialDateRequest $request)
    {
        $new = new SpecialDate();
        $new->fill($request->casts());
        $new->created_by = auth()->id();
        $new->save();
        return $this->response($new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpecialDate  $specialDate
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialDate $specialDate)
    {
        $specialDate->contact;
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
    public function edit(SpecialDate $specialDate)
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
    public function update(SpecialDateRequest $request, SpecialDate $specialDate)
    {
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
    public function destroy(SpecialDate $specialDate)
    {
        $specialDate->delete();

    }
}
