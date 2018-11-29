<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PowerTest extends TestCase
{
    use RefreshDatabase;

    protected $power;

    public function setUp()
    {
        parent::setUp();

        $this->power = create('App\Power');
    }

    /** @test */
    public function a_power_has_many_cards()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->power->cards
        );
    }
}
