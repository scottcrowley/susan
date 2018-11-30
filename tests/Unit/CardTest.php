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

    /** @test */
    public function a_card_can_provide_its_active_status()
    {
        $this->signIn();

        $card = create('App\Card', ['active' => false]);

        $this->assertEquals($card->isActive(), false);
    }

    /** @test */
    public function a_card_can_be_made_inactive_by_its_creator()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id()]);

        $this->assertEquals($card->isActive(), true);

        $this->json('get', route('admin.cards.inactive', $card->id))
            ->assertStatus(204);

        $this->assertEquals($card->fresh()->isActive(), false);
    }

    /** @test */
    public function a_card_can_not_be_made_inactive_if_the_user_isnt_the_creator()
    {
        $this->signIn();

        $card = create('App\Card');

        $this->assertEquals($card->isActive(), true);

        $this->get(route('admin.cards.inactive', $card->id))
            ->assertStatus(403);
    }

    /** @test */
    public function a_card_can_be_made_active_by_its_creator()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id(), 'active' => false]);

        $this->json('get', route('admin.cards.active', $card->id))
            ->assertStatus(204);

        $this->assertEquals($card->fresh()->isActive(), true);
    }

    /** @test */
    public function a_card_can_not_be_made_active_if_the_user_isnt_the_creator()
    {
        $this->signIn();

        $card = create('App\Card', ['active' => false]);

        $this->get(route('admin.cards.active', $card->id))
            ->assertStatus(403);
    }
}
