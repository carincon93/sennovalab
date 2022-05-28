<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceRootUrl(URL::forceRootUrl(env('APP_URL', null)));
        if ($this->app->environment('production') && request()->secure()) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
