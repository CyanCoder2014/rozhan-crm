<?php

namespace App\Http\Controllers;

use App\SmsLog;
use Illuminate\Http\Request;
use Kavenegar\Laravel\Facade;

class SmsController extends Controller
{
    public function Info()
    {
        $AccountInfo =Facade::AccountInfo();
//        dd(mktime(0,0,0,1,1,2020),time());
//        $outinfo = Facade::CountOutbox(mktime(1,1,1,1,1,2019),null);

        return json_encode(compact('outinfo','AccountInfo'));

    }
    public function index()
    {
        $query = SmsLog::select('*');

        if (\request('date_from') && validate_jalili(\request('date_from')))
            $query->whereDate('created_at','>=',to_georgian_date(\request('date_from')));
        if (\request('date_to') && validate_jalili(\request('date_to')))
            $query->whereDate('created_at','<=',to_georgian_date(\request('date_to')));
        if (\request('receptor'))
            $query->where('receptor',\request('receptor'));
        $data = $query->paginate(25);
        return $data;


    }
}
