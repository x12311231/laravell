<?php

namespace App\Listeners;

use App\Events\TestEvent2;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TestListener2
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
     * @param  \App\Events\TestEvent2  $event
     * @return void
     */
    public function handle(TestEvent2 $event)
    {
        //
    }
}
