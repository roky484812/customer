<?php

namespace Roky\CustomerUpdate\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateCustomerServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
    */
    public function register(): void
    {
        $this->app->bind('customerUpdate', function(){
            return new \Roky\CustomerUpdate\Controllers\CustomerUpdateController();
        });
    }

    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        // Route::middleware('api')->group(__DIR__.'/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
    }
}
