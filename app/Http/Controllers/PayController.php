<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders as Order;
use App\Models\Pay;
use App\Jobs\AddScore;
use App\Models\Score;

class PayController extends Controller
{
    //
    protected $order;
    protected $pay;
    //protected $score;

    public function __construct(Pay $pay, Order $order,
    //    Score $score
    )
    {
        $this->pay = $pay;
        $this->order = $order;
    //    $this->score = $score;
    }
    //
    public function notify(Request $request) {
        if (!$this->verify()) {
            return 'false';
        }

        $ordersn = $request->input('ordersn');
        \DB::beginTransaction();
        try {
            $res = $this->order->paid($ordersn);
            $res1 = $this->pay->paid($ordersn);
            if (!$res || !$res1) {
                \DB::rollback();
                return 'false';
            }
            AddScore::dispatch($ordersn);;
        } catch (Exception $e) {
            \DB::rollback();
            return 'false';
        }
        \DB::commit();
        return 'true';
    }

    protected function verify() {
        return true;
    }
}
