<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\AddScore;
use App\Models\Orders as Order;
use App\Models\PayNotify;
use Illuminate\Support\Facades\DB;

class PayNotifyController extends Controller
{
    protected $order;
    protected $payNotify;

    public function __construct(Order $order, PayNotify $payNotify)
    {
        //$this->order = $order;
        //$this->payNotify = $payNotify;
        $this->order = new Orders();
        $this->payNotify = new PayNotify();
    }
    //
    public function notify(Request $request) {
        if (!$this->verify()) {
            return false;
        }

        $ordersn = $request->input('ordersn');
        DB::beginTransaction();
        try {
            $res = $this->order->paid($ordersn);
            $res1 = $this->payNotify->paid($ordersn);
            if (!$res || !$res1) {
                DB::rollback();
                return false;
            }
            AddScore::dispatchNow($ordersn);
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }

    protected function verify() {
        return true;
    }
}
