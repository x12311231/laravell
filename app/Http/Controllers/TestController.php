<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
