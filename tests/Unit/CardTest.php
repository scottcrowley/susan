<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardTest extends TestCase
{
    use RefreshDatabase;

    protected $card;

    public function setUp()
    {
        parent::setUp();

        $this->card = create('App\Card');
    }

    /** @test */
    public function a_card_has_a_creator()
    {
        $this->assertInstanceOf(
            \App\User::class,
            $this->card->creator
        );
    }

    /** @test */
    public function a_card_has_a_rarity()
    {
        $this->assertInstanceOf(
            \App\Rarity::class,
            $this->card->rarity
        );
    }

    /** @test */
    public function a_card_has_a_power()
    {
        $this->assertInstanceOf(
            \App\Power::class,
            $this->card->power
        );
    }
}
