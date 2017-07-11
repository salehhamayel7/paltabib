<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BillServiceProvider extends ServiceProvider
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
        $this->app->bind(BillService::class, function($app) {
            return new BillService();
        });
    }
}
