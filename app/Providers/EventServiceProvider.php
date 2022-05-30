<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\Illuminate\Auth\Events\Logined;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Illuminate\Auth\Listeners\LogLogined;
use App\Listeners\Illuminate\Auth\Listeners\LogLogined1;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Logined::class => [
            LogLogined::class,
            LogLogined1::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
