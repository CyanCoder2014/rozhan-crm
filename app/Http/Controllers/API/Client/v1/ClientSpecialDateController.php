<?php

namespace App\Http\Controllers\API\Client\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientSpecialDateController extends Controller
{
    public function index()
    {
        return auth()->user()->specialDates()->paginate();

    }
}
