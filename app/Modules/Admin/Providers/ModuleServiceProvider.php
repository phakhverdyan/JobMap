<?php

namespace App\Modules\Admin\Providers;

use Illuminate\Support\Facades\View;
use Caffeinated\Modules\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'admin');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'admin');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'admin');

        View::composer(
            'admin::layouts.app', 'App\Modules\Admin\Http\ViewComposer\AdminUserComposer'
        );

//        View::composer('admin::layouts.app', function()
//        {
//            $this->adminUser = Auth::guard('adminUser')->user();
//        });
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
