<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppointmentServiceProvider extends ServiceProvider
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
        $this->app->bind(AppointmentService::class, function($app) {
            return new AppointmentService();
        });
    }
}
