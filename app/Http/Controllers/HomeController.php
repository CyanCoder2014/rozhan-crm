<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\TestRequest;
use App\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{




    public function index(){

            return view('test');

    }



    public function request(){

        return view('request');

    }



    public function payment(){

        return view('payment');

    }



    public function client(){

        return view('client');

    }



    public function clientAdd(){

        return view('clientAdd');

    }



    public function clientSelect(){

        return view('clientSelect');

    }



    public function profile(){

        return view('profile');

    }


    public function report(){

        return view('report');

    }

    public function test(TestRequest $request)
    {
        return ['test'];
    }

}
