<?php

namespace App\Providers;

use App\Facades\AdminFacades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
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

        //将服务以门面的方式注册到容器中
        $loader = AliasLoader::getInstance();
        $loader->alias('AdminFacades', AdminFacades::class);

        $this->app->singleton('Admin', function () {
            return new AdminService;
        });
    }
}
