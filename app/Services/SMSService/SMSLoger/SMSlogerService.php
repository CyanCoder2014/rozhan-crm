<?php


namespace App\Services\SMSService\SMSLoger;


use App\SmsLog;

class SMSlogerService
{
    public function log($data){
        $log = new SmsLog($data);
        $log->save();
    }

}