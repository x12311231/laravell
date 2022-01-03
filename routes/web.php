<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return 'i am ok';
});

Route::get('/tt', [TestController::class, 'index']);
Route::get('/t2', [TestController::class, 'test2']);
Route::get('/t3', [TestController::class, 'test3']);
Route::get('/tsocket', [TestController::class, 'testSocket']);
Route::get('/test/test_order', [TestController::class, 'testOrder']);
Route::get('order/create', [OrderController::class, 'create']);
Route::get('order/create1', [OrderController::class, 'create1']);
Route::get('pay/notify', [PayController::class, 'notify']);


