<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tell Laravel to output clean, standard HTML for pagination
        Paginator::useBootstrapFive();
        
        // Force timezone to Asia/Phnom_Penh (ICT - UTC+7)
        date_default_timezone_set('Asia/Phnom_Penh');
        
        // Set Carbon (Laravel's date library) to use Phnom Penh timezone
        \Carbon\Carbon::setLocale('en');
    }
}
