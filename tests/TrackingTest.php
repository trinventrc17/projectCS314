<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TrackingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPageTracking()
    {
        $this->actingAs($this->user)
            ->visit('inventories/trackings')
            ->seePageIs('inventories/trackings');
    }
}
