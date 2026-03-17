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
        View::composer('layouts.app', function($view){
            $configKeys = ['app_name', 'app_description', 'app_favicon','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });
        
        View::composer('front.layouts.partials.palettes', function($view){
            $configKeys = ['primary','primary-dark','primary-muted','primary-deep','primary-light'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.layouts.app', function($view){
            $configKeys = ['app_name', 'app_description', 'app_favicon','app_status', 'header-background','tagline','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.layouts.meta', function($view){
            $configKeys = ['app_name', 'app_description', 'app_favicon','app_status', 'header-background','tagline','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.menu.index', function($view){
            $configKeys = ['app_name', 'app_description','app_status','app_favicon', 'header-background','typewriter','tagline','footer-contact','footer-mpk-smansa-osis','footer-sponsor','footer-ekskul'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.registrasi.create', function($view){
            $configKeys = ['nama-bank', 'nomor-rekening', 'nama-pemilik-rekening', 'logo-bank'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('back.dashboard.partials.summary-stat', function($view){
            $configKeys = ['nama-bank', 'nomor-rekening', 'nama-pemilik-rekening', 'logo-bank'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('back.registrasi.pdf', function($view){
            $configKeys = ['app_name'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('back.registrasi.card', function($view){
            $configKeys = ['app_name','app_favicon'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('back.layouts.app', function($view){
            $configKeys = ['app_name','app_favicon'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });
        
        View::composer('front.registrasi.card', function($view){
            $configKeys = ['app_name','app_favicon'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.maintenance.index', function($view){
            $configKeys = ['app_favicon', 'app_status'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('front.maintenance.regs-closed', function($view){
            $configKeys = ['app_favicon', 'app_status'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });

        View::composer('errors.layouts.base', function($view){
            $configKeys = ['app_favicon'];
            
            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });
    }
}