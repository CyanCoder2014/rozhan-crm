<?php


namespace App\Services\UserScoreService;


use App\Services\UserScoreService\UserScoreRepository\UserScoreRepository;
use Illuminate\Support\ServiceProvider;

class UserScoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserScoreService::class, function () {
            return new UserScoreService(
                $this->app->make(UserScoreRepository::class));
        });

    }


    public function provides()
    {
        return [
            UserScoreService::class,
            UserScoreRepository::class

        ];
    }
}