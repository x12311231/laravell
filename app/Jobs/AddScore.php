<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Score;

class AddScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ordersn;

    protected $score;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ordersn,
        //Score $score
        )
    {
        //
        $this->ordersn = $ordersn;
        //$this->score = $score;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //远程通知加积分
        $res = app()->get('rpc1')->test();
        if (!$res) {
            throw new Exception('远程调用失败');
        }
        //$res = $this->score->where(['ordersn' => $this->ordersn])->get();
        //if (!$res) {
        //    $this->score->addOne($this->ordersn);
        //}
    }
}
