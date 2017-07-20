<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class HelperServiceProvider extends ServiceProvider
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
        //
        $this->app->bind('functions', function(){
            return new \App\Helpers\functions;
        });
    }

    public static function getGreatestIDfrom($table_name){
        
        $temp = DB::table($table_name)->select(DB::raw('max(id) as greatest_id'))->first();
        $id=$temp->greatest_id;
       
        return $id;
    }
}
