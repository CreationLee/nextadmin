<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\AdminService;

class AdminServiceProvider extends ServiceProvider
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
        $this->app->singleton('Admin', function () {
            return new AdminService;
        });
    }
}
