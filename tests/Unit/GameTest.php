<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_game_can_be_initialized()
    {
        $this->withoutExceptionHandling();

        $this->signIn($john = create('App\User', ['name' => 'John Doe']));
        $jane = create('App\User', ['name' => 'Jane Doe']);

        $game = json_encode($this->generateGameMeta($john, [$john, $jane]));

        $response = $this->json('post', route('api.initialize'), ['players' => [$john, $jane]]);

        $this->assertEquals($game, $response->getContent());
    }

    /** @test */
    public function a_game_requires_a_mininum_number_of_players()
    {
        $this->signIn($john = create('App\User', ['name' => 'John Doe']));

        $this->post(route('api.initialize'), ['players' => [$john]])
            ->assertSessionHasErrors('players');
    }

    /** @test */
    public function a_game_has_a_maximum_number_of_players()
    {
        config()->set('susan.max_players', 3);

        $this->signIn($john = create('App\User', ['name' => 'John Doe']));

        $player_two = create('App\User');
        $player_three = create('App\User');
        $player_four = create('App\User');

        $this->post(route('api.initialize'), ['players' => [$john, $player_two, $player_three, $player_four]])
            ->assertSessionHasErrors('players');
    }

    /** @test */
    public function a_game_can_be_completed()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $game = create('App\Game');

        $this->json('get', route('api.complete', $game->id))
            ->assertStatus(200);

        $this->assertTrue($game->fresh()->completed);
    }

    /** @test */
    public function it_can_be_determined_if_a_game_is_completed()
    {
        $game = factory('App\Game')->states('completed')->create();

        $this->assertTrue($game->isCompleted());
    }

    /** @test */
    public function a_game_can_be_archived()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $game = create('App\Game');

        $this->json('get', route('api.archive', $game->id))
            ->assertStatus(200);

        $this->assertTrue($game->fresh()->isArchived());
    }

    /** @test */
    public function it_can_be_determined_if_a_game_is_archived()
    {
        $game = create('App\Game', ['archived' => true]);

        $this->assertTrue($game->isArchived());
    }

    public function generateGameMeta($creator, $players)
    {
        $game = [
            'rules' => [
                'min_players' => config('susan.min_players'),
                'max_players' => config('susan.max_players'),
                'starting_card_count' => config('susan.starting_card_count')
            ],
            'players' => []
        ];

        foreach ($players as $player) {
            $game['players'][$player->id] = [
                'name' => $player->name,
                'starting_cards' => []
            ];
        }

        return $game;
    }
}
