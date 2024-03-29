<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Facade;

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
        Facade::clearResolvedInstances();
        
        if (\App::environment(['production']) || \App::environment(['develop'])) {
            \URL::forceScheme('https');
        }
    }
}
