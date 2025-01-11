<?php

namespace App\Providers;

use App\Models\Config;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TemplateProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layouts.app', function($view){
            $configKeys = ['app_name', 'app_description', 'app_favicon', 'header-background','header-logo-left','header-logo-right','tagline','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.menu.index', function($view){
            $configKeys = ['app_name', 'app_description', 'app_favicon', 'header-background','header-logo-left','header-logo-right','tagline','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });
    }
}