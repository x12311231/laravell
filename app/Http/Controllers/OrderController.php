<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CloseOrder;
use App\Jobs\CloseOrderFail;
use App\Models\Orders;

class OrderController extends Controller
{
    //
    public function create() {
        \DB::beginTransaction();
        try {
            $order = Orders::create([
                'name' => 'create',
                'ordersn' => time() . rand(1, 100),
            ]);
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
