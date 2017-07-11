<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DoctorServiceProvider extends ServiceProvider
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
         $this->app->bind(DoctorService::class, function($app) {
            return new DoctorService();
        });
    }
}
