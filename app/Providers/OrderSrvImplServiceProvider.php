<?php


namespace App\Providers;


use App\Repositories\OrderSrvImpl;
use App\Services\DiscountService\DiscountService;
use App\Services\UserGiftService\UserGiftService;
use App\Services\UserScoreService\UserScoreService;
use Illuminate\Support\ServiceProvider;

class OrderSrvImplServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrderSrvImpl::class, function () {
            return new OrderSrvImpl(
                $this->app->make(UserScoreService::class),
                $this->app->make(UserGiftService::class),
                $this->app->make(DiscountService::class));
        });

    }


    public function provides()
    {
        return [
            UserScoreService::class,
            OrderSrvImpl::class

        ];
    }
}