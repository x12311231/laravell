<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayNotify extends Model
{
    use HasFactory;

    protected $fillable = ['ordersn', 'update_at', 'is_pay', 'is_add_score', 'pay_at'];

    public function paid(string $ordersn)
    {

        return $this->where(['ordersn' => $ordersn])
            ->update(['is_pay' => 1]);
    }

    public function addScored($ordersn)
    {
        return $this->where(['ordersn' => $ordersn])
            ->update(['is_add_score' => 1]);
    }
}
