<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders as Order;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['ordersn', 'score'];

    public function addOne(string $ordersn)
    {
        $this->ordersn = $ordersn;
        $order = Order::where(['ordersn' => $ordersn])->get();
        if (!$order) {
            throw new Exception('order not found');
        }
        $this->score = $order->score;
        return $this->save();
    }
}
