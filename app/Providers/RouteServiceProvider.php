<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapSuperAdminApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware(['api', 'cooperation'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));


        Route::prefix('client-api')
            ->middleware(['api', 'cooperation'])
            ->namespace($this->namespace . '\API\Client')
            ->group(base_path('routes/api/client.php'));


        Route::prefix('admin-api')
            ->middleware(['api', 'cooperation'])
            ->namespace($this->namespace . '\API\Admin')
            ->group(base_path('routes/api/admin.php'));
    }

    protected function mapSuperAdminApiRoutes()
    {
        Route::prefix('super-admin-api')
             ->middleware('api')
             ->namespace($this->namespace . '\API\SuperAdmin')
             ->group(base_path('routes/api/super-admin.php'));
    }
}
