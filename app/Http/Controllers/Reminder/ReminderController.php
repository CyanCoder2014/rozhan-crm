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
        return $this->response($this->service->clientsReminder($date_from,$date_to),'success');

    }
    public function personnels(Request $request)
    {
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);
        return $this->response($this->service->personnelsReminder($date_from,$date_to),'success');

    }
    public function user(Request $request)
    {
        $this->validate($request,[
            'user_id' => ['required','exists:users,id']
        ]);
        $date_from=null;
        $date_to=null;
        if (validate_jalili($request->date_from))
            $date_from= to_georgian_date($request->date_from);
        if (validate_jalili($request->date_to))
            $date_to= to_georgian_date($request->date_to);

        return $this->response($this->service->UserReminder($request->user_id,$date_from,$date_to),'success');

    }
}
