<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;

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
        Orders::insert([
            'name' => 'test',
            'ordersn' => time(),
        ]);
        $this->dispatch(new CloseOrder())
    }
}
