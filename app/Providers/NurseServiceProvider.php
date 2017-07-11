<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NurseServiceProvider extends ServiceProvider
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
        $this->app->bind(NurseService::class, function($app) {
            return new NurseService();
        });
    }
}
