<?php

namespace App\Listeners;

use App\Events\TestEvent2;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TestListener2_1 implements ShouldQueue
{

    // use Queueable;
    /**
     * 任务将被发送到的队列的名称。
     *
     * @var string|null
     */
    public $queue = 'listeners';

    public $delay = 12;

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
        Log::debug('触发事件监听App\Listeners\TestListener2_1');
    }
}
