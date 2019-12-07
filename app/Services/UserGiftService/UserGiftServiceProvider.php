<?php


namespace App\Services\UserGiftService;


use App\Services\UserGiftService\UserGiftRepository\UserGiftRepository;
use App\Services\UserScoreService\UserScoreService;
use Illuminate\Support\ServiceProvider;

class UserGiftServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserGiftService::class,function ($app) {
            return new UserGiftService($app->make(UserScoreService::class),$app->make(UserGiftRepository::class));
        });
    }
}