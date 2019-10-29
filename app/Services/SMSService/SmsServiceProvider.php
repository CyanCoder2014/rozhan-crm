<?php


namespace App\Services\SMSService;


use App\Services\SMSService\SMSLoger\SMSlogerService;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SmsService::class,function ($app) {
            return new KavenegarSmsService($app->make(SMSlogerService::class));
        });
    }

}