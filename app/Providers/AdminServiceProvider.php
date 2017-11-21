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
<<<<<<< HEAD

        $this->app->singleton('Admin',function(){
            return new AdminService();
        });

=======
        $this->app->singleton('Admin', function () {
            return new AdminService;
        });
>>>>>>> 45ef0167b8612174e00cd4c57dae797c0e0729ac
    }
}
