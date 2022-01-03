<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Rpc1ServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('rpc1', function ($app) {
            $config = $app->make('config')->get('rpc1');

            $logger = $app->get('log');
            return new \X12311231\Rpc1\Client\Client($config['driver'], $config['server'], $logger);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
