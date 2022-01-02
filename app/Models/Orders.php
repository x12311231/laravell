<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ordersn', 'is_close', 'pay_at'];

    /**
     *
     */
    public function paid($ordersn)
    {
        $this->pay_at = time();
        return $this->save();
    }
}
