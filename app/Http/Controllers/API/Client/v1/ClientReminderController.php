<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\Reminder\ReminderDateRequset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientReminderController extends Controller
{
    public function index()
    {
        return auth()->user()->reminders()->paginate();

    }
    public function get(ReminderDateRequset $requset)
    {
        return $this->response(auth()->user()->reminders()
            ->whereDate('reminder_at','>=',to_georgian_date($requset->date_from))
            ->whereDate('reminder_at','<=',to_georgian_date($requset->date_to))
            ->get());

    }
}
