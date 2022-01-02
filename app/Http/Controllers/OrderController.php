<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create() {
        $order = Orders::create([
            'name' => 'test',
            'ordersn' => time() . rand(1, 100),
        ]);
        //$this->dispatch((new CloseOrder($order, 30))->onQueue('default'));
        CloseOrder::dispatch($order, 30)
            ->delay(now()->addMinutes(1));
        return $order;

    }

}
