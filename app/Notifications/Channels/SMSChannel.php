<?php


namespace App\Notifications\Channels;


use App\Services\SMSService\SmsService;
use Illuminate\Notifications\Notification;

class SMSChannel
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
        $message = $notification->toSms($notifiable);
        $receptor = $notifiable->routeNotificationForSms($notification);
        $this->smsService->Send($receptor,$message);
        if ($this->smsService->Send($receptor,$message))
            return true;

        // Send notification to the $notifiable instance...
    }

}