<?php

namespace Tests\Feature;

use App\Game;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_player_can_get_all_their_won_games()
    {
        $this->withoutExceptionHandling();

        $this->signIn($john = create('App\User', ['name' => 'JohnDoe']));
        $jane = create('App\User', ['name' => 'JaneDoe']);

        $response = $this->json('post', route('api.initialize'), ['players' => [$john, $jane]]);
        $gameDetails = parseResponse($response);

        $game = Game::where('id', $gameDetails['id'])->first();

        $this->json('post', route('api.winner', [$game->id, $john->id]));

        create('App\Game', [], 2);

        $allGames = Game::all();

        $this->assertCount(3, $allGames);

        $won = $john->won;

        $this->assertCount(1, $won);
    }

    /** @test */
    public function a_player_can_see_all_games_they_have_played()
    {
        //
    }

    // /** @test */
    // public function a_player_can_see_a_list_of_all_other_available_players_besides_themselves()
    // {
    //     $this->signIn($john = create('App\User', ['name' => 'JohnDoe']));

    //     create('App\User', [], 10);
    // }
}
