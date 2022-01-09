<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('production')) {
            error_reporting(E_ALL ^ E_NOTICE);
        }
        if ($this->app->environment(['local', 'dev'])) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal() || mb_strtolower(app()->environment()) === 'dev') {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
