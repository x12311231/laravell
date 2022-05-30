<?php

namespace App\Listeners\Illuminate\Auth\Listeners;

use App\Events\Illuminate\Auth\Events\Logined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogLogined1
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Logined  $event
     * @return void
     */
    public function handle(Logined $event)
    {
        Log::debug('用户登录2');
    }
}
