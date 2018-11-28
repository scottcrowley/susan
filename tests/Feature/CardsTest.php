<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_cards()
    {
        $this->signIn();

        $card = create('App\Card');

        $this->get(route('admin.cards.index'))
            ->assertSee($card->name);
    }

    /** @test */
    public function an_authenticated_user_can_create_a_new_card()
    {
        $this->signIn();

        $card = make('App\Card');

        $this->post(route('admin.cards.store'), $card->toArray());

        $this->assertDatabaseHas('cards', ['name' => $card->name]);
    }

    /** @test */
    public function a_card_requires_a_unique_name()
    {
        $this->signIn();

        $card = make('App\Card', ['name' => '']);

        $this->post(route('admin.cards.store'), $card->toArray())
            ->assertSessionHasErrors('name');

        $card->name = 'Card 1';

        $card_test = create('App\Card', ['name' => 'Card 1']);

        $this->post(route('admin.cards.store'), $card->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_view_a_card()
    {
        $this->signIn();

        $card = create('App\Card');

        $this->get(route('admin.cards.show', $card->id))
            ->assertSee($card->name)
            ->assertSee($card->health)
            ->assertSee($card->damage);
    }

    /** @test */
    public function a_user_can_edit_a_card_that_they_created()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id()]);

        $this->get(route('admin.cards.edit', $card->id))
            ->assertSee($card->name)
            ->assertSee('Update Card');
    }

    /** @test */
    public function a_user_can_update_a_card_that_they_created()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id(), 'name' => 'Card Name']);

        $card->name = 'New Card Name';

        $this->patch(route('admin.cards.update', $card->id), $card->toArray());

        $this->get(route('admin.cards.show', $card->id))
            ->assertSee('New Card Name');

        $card->damage = 1000;
    }

    /** @test */
    public function a_user_cannot_update_a_card_they_did_not_create()
    {
        $this->signIn();

        $user = create('App\User');

        $card = create('App\Card', ['name' => 'This is my card', 'user_id' => $user->id]);

        $card->name = 'This is now my card';

        $this->json('get', route('admin.cards.edit', $card->id))
            ->assertStatus(403);

        $this->json('patch', route('admin.cards.update', $card->id), $card->toArray())
            ->assertStatus(403);
    }

    /** @test */
    public function a_card_can_be_updated_with_the_same_name()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id(), 'damage' => 100]);

        $card->damage = 1000;

        $this->json('patch', route('admin.cards.update', $card->id), $card->toArray())
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_a_card_that_they_created()
    {
        $this->signIn();

        $card = create('App\Card', ['user_id' => auth()->id()]);

        $this->json('delete', route('admin.cards.delete', $card->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('cards', ['id' => $card->id]);
    }

    /** @test */
    public function a_user_cannot_delete_a_card_they_did_not_create()
    {
        $this->signIn();

        $card = create('App\Card');

        $this->json('delete', route('admin.cards.delete', $card->id))
            ->assertStatus(403);
    }
}
