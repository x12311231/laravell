<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\Illuminate\Auth\Events\Logined;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Illuminate\Auth\Listeners\LogLogined;
use App\Listeners\Illuminate\Auth\Listeners\LogLogined1;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\TestEvent;
use App\Listeners\TestListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

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
        ],
        TestEvent::class => [
            TestListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(function(Login $event) {
            Log::debug('用户登录了，闭包事件记录' . var_export($event, true));
        });
    }
}
