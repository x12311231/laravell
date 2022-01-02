<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Jobs\CloseOrder;

class TestController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }
    //
    public function index() {
        return $this->user;
    }

    public function testOrder() {
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
