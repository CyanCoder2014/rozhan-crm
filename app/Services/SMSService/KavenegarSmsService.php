<?php


namespace App\Services\SMSService;


use Kavenegar\Exceptions\ApiException;
use Kavenegar\Laravel\Facade;

class KavenegarSmsService extends SmsService
{
    protected $sender = null;
    public function Send($receptor, $message)
    {
        try{
           
            $result = Facade::Send($this->sender,$receptor,$message);
            if($result){
                foreach($result as $r){
                    $this->setLogData(
                        [
                            "messageid" => $r->messageid,
                            "message" => $r->message,
                            "status" => $r->status,
                            "statustext" => $r->statustext,
                            "sender" => $r->sender,
                            "receptor" => $r->receptor,
                            "date" => $r->date,
                            "cost" => $r->cost,
                            ]);
                    $this->setStatus($r->status);
                    
                }
            }
        }
        catch(ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            $this->setLogData(
                [
                    "message" => $message,
                    "status" => $e->getCode(),
                    "statustext" => $e->errorMessage(),
                    "sender" => $this->sender,
                    "receptor" => $receptor,
                    "cost" => 0,
                ]);
            $this->setStatus($e->getCode());
        }
        catch(\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            $this->setLogData(
                [
                    "message" => $message,
                    "status" => $e->getCode(),
                    "statustext" => $e->errorMessage(),
                    "sender" => $this->sender,
                    "receptor" => $receptor,
                    "cost" => 0,
                ]);
            $this->setStatus($e->getCode());
        }
        parent::Send($receptor, $message); // TODO: Change the autogenerated stub
    }

    public function TemplateSend($receptor, $template, $token, $token2, $token3, $token10=null, $token20=null):bool
    {
        try{

            $result = Facade::VerifyLookup($receptor, $token, $token2, $token3, $template, $type = null,$token10,$token20);
            if($result){
                foreach($result as $r){
                    $this->setLogData(
                        [
                            "messageid" => $r->messageid,
                            "message" => $r->message,
                            "status" => $r->status,
                            "statustext" => $r->statustext,
                            "sender" => $r->sender,
                            "receptor" => $r->receptor,
                            "date" => $r->date,
                            "cost" => $r->cost,
                        ]);
                    $this->setStatus($r->status);

                }
            }
        }
        catch(ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            $this->setLogData(
                [
                    "message" => $template.' '.$token.' '.$token2.' '.$token3.' '.$token10.' '.$token20,
                    "status" => $e->getCode(),
                    "statustext" => $e->errorMessage(),
                    "sender" => $this->sender,
                    "receptor" => $receptor,
                    "cost" => 0,
                ]);
            $this->setStatus($e->getCode());
        }
        catch(\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            $this->setLogData(
                [
                    "message" => $template.' '.$token.' '.$token2.' '.$token3.' '.$token10.' '.$token20,
                    "status" => $e->getCode(),
                    "statustext" => $e->errorMessage(),
                    "sender" => $this->sender,
                    "receptor" => $receptor,
                    "cost" => 0,
                ]);
            $this->setStatus($e->getCode());
        }
        return parent::TemplateSend($receptor, $template, $token, $token2, $token3); // TODO: Change the autogenerated stub

    }

}