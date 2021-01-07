<?php

namespace Sunfire\Cookie;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;

class SunfireCookieServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/cookie.php', 'sun-cookie');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sun-cookie');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sun-cookie');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->app['view']->composer('sun-cookie::index', function (View $view) {
            $cookieConsentConfig = config('sun-cookie');

            $view->with(compact('cookieConsentConfig'));
        });

        Blade::directive('sunfireCookieScript', [SunfireCookieBladeDirectives::class, 'script']);
    }
}
