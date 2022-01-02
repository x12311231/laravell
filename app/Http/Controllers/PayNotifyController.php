<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\AddScore;
use App\Models\Orders as Order;
use app\Models\PayNotify;

class PayNotifyController extends Controller
{
    //
    public function notify() {
        if (!$this->verify()) {
            return false;
        }

        $ordersn = Request::param('ordersn');
        DB::beginTransactions();
        try {
            $res = Order::paid($ordersn);
            $res1 = PayNotify::paid($ordersn);
            if (!$res || !$res1) {
                DB::rollback();
                return false;
            }
            AddScore::dispatchNow($ordersn);
        } catch (Exception $e) {
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
