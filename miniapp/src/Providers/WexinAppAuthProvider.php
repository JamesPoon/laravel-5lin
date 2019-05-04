<?php

namespace Weixin\App\Providers;

use Illuminate\Support\ServiceProvider;

class WexinAppAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/route.php");
        $this->mergeConfigFrom(
            __DIR__.'/../config/mapp.php', 'mapp'
        );
    }
}
