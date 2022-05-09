<?php

namespace App\Http\Controllers;

use App\Jobs\Chain1;
use App\Jobs\Chain2;
use App\Jobs\Chain3;
use App\Jobs\ExceptJob;
use App\Jobs\Hello;
use App\Jobs\Hello2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class TestJobController extends Controller
{
    public function testChain() {
        Log::debug('[testChain]');
        Bus::chain([
            new Hello('hello test', 5),
            new Hello2,
        ])->dispatch();
    }

    public function testChainException() {
        Log::debug('[testChainException]');
        Bus::chain([
            new Hello('hello test', 5),
            new ExceptJob,
            new Hello2,
        ])
        ->catch(function(Throwable $e) {
            Log::error('[testChainException]' . json_encode($e->getMessage()));
        })
        ->dispatch();
    }

    public function testChainExceptionButNoRollback() {
        $task = "task rollback " . date('YmdHis');
        Log::debug('[testChainExceptionButNoRollback]');
        Bus::chain([
            new Chain1($task),
            new Chain2($task),
            new Chain3($task),
        ])->catch(function(Throwable $e) {
            Log::emergency('[testChainExceptionButNoRollback]');
            return;
        })->dispatch();
    }

    public function testChainExceptionRollback() {
        $task = "task rollback " . date('YmdHis');
        Log::debug('[testChainExceptionRollback]');
        DB::beginTransaction();
        Bus::chain([
            new Chain1($task),
            new Chain2($task),
            new Chain3($task),
        ])->catch(function(Throwable $e) {
            Log::emergency('[testChainExceptionRollback]');
            DB::rollBack();
            return;
        })->dispatch();
        DB::commit();
    }

    public function testChainCommit() {
        $task = "task commit " . date('YmdHis');
        Log::debug('[testChainCommit]');
        DB::beginTransaction();
        Bus::chain([
            new Chain1($task),
            new Chain3($task),
        ])->catch(function(Throwable $e) {
            Log::emergency('[testChainExceptionRollback]');
            DB::rollBack();
            return;
        })->dispatch();
        DB::commit();
    }

    public function testChain1Simple() {
        Chain1::dispatchSync(' hello chain 1');
    }
}
