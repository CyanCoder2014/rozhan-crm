<?php


namespace App\Notifications\Channels;


use App\Services\SMSService\SmsService;
use Illuminate\Notifications\Notification;

class TemplateSmsChannel
{
    /**
     * @var SmsService
     */
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;

    }

    public function send($notifiable, Notification $notification)
    {
        $template = $notification->getTemplate();
        $token = $notification->getToken();
        $token2 = $notification->getToken2();
        $token3 = $notification->getToken3();
        $token10 = $notification->getToken10();
        $token20 = $notification->getToken20();
        $receptor = $notifiable->routeNotificationForSms($notification);
        if ($this->smsService->TemplateSend($receptor,$template,$token,$token2,$token3,$token10,$token20))
            return true;

        // Send notification to the $notifiable instance...
    }




}
