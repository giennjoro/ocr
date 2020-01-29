<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use DateTime;
use DateTimeZone;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength
        $dt = new DateTime("now", new DateTimeZone('Africa/Nairobi')); //first argument "must" be a string
        $now = $dt->format('Y-m-d H:i:s');
        View::share('current_time', $now);
    }
}
