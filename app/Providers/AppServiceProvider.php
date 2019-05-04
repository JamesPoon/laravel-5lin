<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Weixin\App\Providers\WexinAppAuthProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(WexinAppAuthProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
