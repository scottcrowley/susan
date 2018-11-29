<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RarityTest extends TestCase
{
    use RefreshDatabase;

    protected $rarity;

    public function setUp()
    {
        parent::setUp();

        $this->rarity = create('App\Rarity');
    }

    /** @test */
    public function a_rarity_has_many_cards()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->rarity->cards
        );
    }
}
