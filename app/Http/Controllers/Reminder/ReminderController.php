<?php

namespace App\Http\Controllers\Reminder;

use App\Services\ReminderService\ReminderService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    /**
     * @var ReminderService
     */
    protected $service;
    public function __construct(ReminderService $service)
    {
        $this->service = $service;
    }

    public function client(Request $request)
    {
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);
        return $this->service->clientsReminder($date_from,$date_to);

    }
    public function personnels(Request $request)
    {
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);
        return $this->service->personnelsReminder($date_from,$date_to);

    }
    public function user(Request $request)
    {

        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);

        return $this->service->UserReminder($request->user_id,$date_from,$date_to);

    }
}
