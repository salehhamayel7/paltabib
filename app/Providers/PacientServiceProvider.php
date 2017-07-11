<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PacientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PacientService::class, function($app) {
            return new PacientService();
        });
    }
}
