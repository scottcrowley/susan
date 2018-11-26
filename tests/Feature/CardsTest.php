<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_create_a_new_card()
    {
        $this->signIn();

        $card = factory('App\Card')->make();

        $this->post(route('admin.cards.store'), $card->toArray());

        $this->assertDatabaseHas('cards', ['name' => $card->name]);
    }

    /** @test */
    public function a_card_requires_a_unique_name()
    {
        $this->signIn();

        $card = factory('App\Card', ['name' => ''])->make();

        $this->post(route('admin.cards.store'), $card->toArray())
            ->assertSessionHasErrors('name');

        $card->name = 'Card 1';

        $card_test = factory('App\Card', ['name' => 'Card 1'])->create();

        $this->post(route('admin.cards.store'), $card->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_card_can_be_shown()
    {
        $this->signIn();

        $card = factory('App\Card')->create();

        $this->get(route('admin.cards.show', $card->id))
            ->assertSee($card->name)
            ->assertSee($card->health)
            ->assertSee($card->damage);
    }

    /** @test */
    public function a_card_can_be_edited()
    {
        $this->signIn();

        $card = factory('App\Card')->create();

        $this->get(route('admin.cards.edit', $card->id))
            ->assertSee($card->name)
            ->assertSee('Update Card');
    }

    /** @test */
    public function a_card_can_be_updated()
    {
        $this->signIn();

        $card = factory('App\Card')->create();

        $card->name = 'New Card Name';

        $this->patch(route('admin.cards.update', $card->id), $card->toArray());

        $this->get(route('admin.cards.show', $card->id))
            ->assertSee('New Card Name');
    }

    /** @test */
    public function a_card_can_be_deleted()
    {
        $this->signIn();

        $card = factory('App\Card')->create();

        $this->json('DELETE', route('admin.cards.delete', $card->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('cards', ['id' => $card->id]);
    }
}
