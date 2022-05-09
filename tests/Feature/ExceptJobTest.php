<?php

namespace Tests\Feature;

use App\Jobs\ExceptJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExceptJobTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        try {
            ExceptJob::dispatch()->delay(10);
        } catch (\Exception $e) {
            $this->assertEquals('test ExceptJob', $e->getMessage());
        }
    }
}
