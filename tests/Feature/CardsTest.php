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
}
