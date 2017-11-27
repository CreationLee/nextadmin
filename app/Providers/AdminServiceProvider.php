<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Service\AdminService;
use App\Facades\AdminFacades;

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
        $loader = AliasLoader::getInstance();
        $loader->alias('AdminFacades',AdminFacades::class);

        $this->app->singleton('Admin', function () {
            return new AdminService;
        });

        $this->loadHelpers();
    }

    /**
     * load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(base_path().'/app//Helpers/*.php') as $filename ) {
            require_once $filename;
        }
    }
}
