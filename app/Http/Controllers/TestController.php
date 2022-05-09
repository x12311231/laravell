<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Jobs\CloseOrder;
use App\Jobs\CloseOrderFail;
use App\Jobs\Hello;
use Illuminate\Support\Facades\Log;
use X12311231\Rpc1\Test1;
use X12311231\Rpc1\Client\Client;

class TestController extends Controller
{
    private $user;

    private $test1;
    private $rpc1;

    public function __construct(
        User $user,
        Test1 $test1,
    //    Client $rpc1
    ) {
        $this->user = $user;
        $this->test1 = $test1;
     //   $this->rpc1 = $rpc1;
    }
    //
    public function index() {
        return $this->user;
    }

    public function testOrder() {
        $order = Orders::create([
            'name' => 'test',
            'score' => 10,
            'ordersn' => time() . rand(1, 100),
        ]);
        //$this->dispatch((new CloseOrder($order, 30))->onQueue('default'));
        CloseOrder::dispatch($order, 30);
            // ->delay(now()->addMinutes(1));

        // CloseOrderFail::dispatch($order, 10)
        // ->delay(now()->addMinutes(1));
        return $order;

    }

    public function testHelloJob() {
        Log::debug('helo job');
        // Hello::dispatch('hello job ok', 0);
        Hello::dispatch('hello job ' . time(), 10);
    }

    public function test2()
    {

        $res = Test1::test1();
        return $res;
    }

    public function test3()
    {
        return $this->test1->test();
    }

    public function testSocket()
    {
        return app()->get('rpc1')->test();
    }
    public function testSocket1()
    {

        $config = app()->make('config')->get('rpc1');
            //dd($config);
        $rpc = new Client($config['driver'], $config['server'], app()->get('log'));
        $rpc->test();
    }

    public function testSleep() {
        sleep(10);
        return 'sleep 10';
    }
}
