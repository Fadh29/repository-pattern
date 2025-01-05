<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\JurusanRepositoryInterface::class,
            \App\Repositories\Eloquent\JurusanRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\PesertaRepositoryInterface::class,
            \App\Repositories\Eloquent\PesertaRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\PesertaRepositoryInterface::class,
            \App\Repositories\Eloquent\PesertaRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot()
    // {
    //     $this->configureRateLimiting();

    //     $this->routes(function () {
    //         Route::prefix('api') // Menambahkan prefix 'api' di URL
    //             ->middleware('api') // Middleware untuk API
    //             ->namespace($this->namespace) // Menentukan namespace untuk controller
    //             ->group(base_path('routes/api.php')); // Menentukan file rute untuk API

    //         Route::middleware('web') // Middleware untuk web routes
    //             ->namespace($this->namespace) // Menentukan namespace untuk controller
    //             ->group(base_path('routes/web.php')); // Menentukan file rute untuk Web
    //     });
    // }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        //
    }
}
