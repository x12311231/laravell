<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use app\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orders $order, $delay)
    {
        //
        $this->order = $order;
        $this->delay($delay);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('-------------------order------------:' . var_export($this->order, true));
        //// 判断对应的订单是否已经被支付
        // 如果已经支付则不需要关闭订单，直接退出
        Log::debug('-------sdfasdf--------------' . var_export($this->order, true));
        if ($this->order->pay_at) {
            Log::debug('---------------------');
            return;
        }
        // $this->order->update(['is_close' => 1]);
        // 通过事务执行 sql
        DB::transaction(function() {
            // 将订单的 is_close 字段标记为 true，即关闭订单
            $this->order->update(['is_close' => 1]);
            // 循环遍历订单中的商品 SKU，将订单中的数量加回到 SKU 的库存中去
            // foreach ($this->order->items as $item) {
            //     $item->productSku->addStock($item->amount);
            // }
        });
    }
}
