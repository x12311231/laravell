<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ordersn', 'is_close', 'pay_at', 'score'];

    /**
     *
     */
    public function paid($ordersn)
    {

        return $this->where(['ordersn' => $ordersn])
            ->update([
                //'is_pay' => 1,
                'pay_at' => date('Y-m-d H:i:s')
            ]);

    }

    public function addOne($ordersn)
    {
        $this->name = 'test3';
        $this->ordersn = time() . rand(0, 100);
        $this->score = 10;
        return $this->save();
    }

}
