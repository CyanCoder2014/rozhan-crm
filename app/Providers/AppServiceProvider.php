<?php

namespace App\Providers;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Repositories\AppRepositoryImpl;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\OrderSrv;
use App\Repositories\OrderSrvImpl;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->when(ContactController::class)
            ->needs(AppRepository::class)
            ->give(AppRepositoryImpl::class);



        $this->app->when(OrderController::class)
            ->needs(AppRepository::class)
            ->give(AppRepositoryImpl::class);

        $this->app->when(OrderController::class)
            ->needs(OrderSrv::class)
            ->give(OrderSrvImpl::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Request::getHost() != 'localhost')
        {
            \URL::forceRootUrl(\Config::get('app.url'));
            \URL::forceScheme('https');
        }
    }
}
