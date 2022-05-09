<?php

namespace App\Jobs;

use App\Models\Chain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Chain2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = 'chain2 ' . $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Chain::create(['name' => $this->name, 'status' => 'a']); // 抛出异常

    }
}
