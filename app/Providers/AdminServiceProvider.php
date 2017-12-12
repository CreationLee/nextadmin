<?php

namespace App\Providers;

use App\Facades\AdminFacades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Service\AdminService;
use Illuminate\Routing\Router;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\View;
use Arrilot\Widgets\Facade as Widget;
use Arrilot\Widgets\ServiceProvider as WidgetServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $dispatcher)
    {
        /**
         * registe an event and listener
         */
        $dispatcher->listen('testing',function(){
            $than = 12;
        });

        // TODO register the link issues
        $this->registerViewComposers();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(WidgetServiceProvider::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('AdminFacades',AdminFacades::class);

        $this->app->singleton('Admin', function () {
            return new AdminService;
        });

        $this->loadHelpers();

        $this->registerWidgets();
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

    /**
     * register view composer event
     */
    protected function registerViewComposers()
    {
        //register alerts
        View::composer('admin.*',function($view){
            $view->with('alerts',AdminFacades::alerts());
        });
    }

    /*
     * registe widgets
     */
    protected function registerWidgets()
    {
        $default_widgets = ['App\\Widgets\\PageDimmer','App\\Widgets\\PostDimmer','App\\Widgets\\UserDimmer'];
        $widgets = config('admin.dashboard.widgets',$default_widgets);

        foreach($widgets as $widget) {
            Widget::group('admin.dimmers')->addWidget($widget);
        }
    }

}
