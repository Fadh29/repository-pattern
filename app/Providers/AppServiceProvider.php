<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        //
    }
}
