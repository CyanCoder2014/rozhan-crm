<?php


namespace App\Services\ReminderService;


use App\Services\ReminderService\ReminderRepository\ReminderRepository;
use Illuminate\Support\ServiceProvider;

class ReminderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ReminderService::class, function () {
            return new ReminderService(
                $this->app->make(ReminderRepository::class));
        });

    }


    public function provides()
    {
        return [
            ReminderService::class,
            ReminderRepository::class

        ];
    }
}