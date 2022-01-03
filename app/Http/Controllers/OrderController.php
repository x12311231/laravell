<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CloseOrder;
use App\Jobs\CloseOrderFail;
use App\Models\Orders as Order;
use App\Models\Pay;

class OrderController extends Controller
{
    protected $pay;
    protected $order;

    public function __construct(Pay $pay, Order $order)
    {
        $this->pay = $pay;
        $this->order = $order;
    }
    //
    public function create() {
        $ordersn = time() . rand(0, 100);
        \DB::beginTransaction();
        try {
            //$order = $this->order->addOne($ordersn);
            $order = Order::create([
                'score' => 10,
                'name' => 'create',
                'ordersn' => $ordersn,
            ]);
            $this->pay->addOne($ordersn);
            //$this->dispatch((new CloseOrder($order, 30))->onQueue('default'));
            CloseOrder::dispatch($order, 30)
                ->delay(now()->addMinutes(1));
        } catch(Exception $e) {
            \DB::rollback();
            return false;
        }
        \DB::commit();
        return $order;

    }
    //
    public function create1() {
        \DB::beginTransaction();
        try {
            $order = Orders::create([
                'name' => 'create1',
                'ordersn' => time() . rand(1, 100),
                'score' => 10,
            ]);
            //$this->dispatch((new CloseOrder($order, 30))->onQueue('default'));
            CloseOrderFail::dispatch($order, 30)
                ->delay(now()->addMinutes(1));
        } catch(Exception $e) {
            \DB::rollback();
            return false;
        }
        \DB::commit();
        return $order;

    }
}
