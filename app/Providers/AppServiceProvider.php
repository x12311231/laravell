<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        //
        Log::debug('testtttttttttttttt');
        DB::listen(function($sql) {
            Log::debug('[sql]' . $sql->sql);
            Log::debug('[sql]' . var_export(json_encode($sql), true));
        });
    }
}
