<?php

namespace Tests\Feature;

use App\Game;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_non_archived_games()
    {
        $this->withoutExceptionHandling();
        $this->signIn($john = create('App\User', ['name' => 'JohnDoe']));
        $jane = create('App\User', ['name' => 'JaneDoe']);

        $game = $this->json('post', route('api.initialize'), ['players' => [$john, $jane]]);

        $now = \Carbon\Carbon::now()->format('D, M jS, Y h:i A');

        $name = $john->name.' vs. '.$jane->name.' - '.$now;

        $this->get(route('games.index'))
            ->assertSee($name);
    }

    /** @test */
    public function a_game_can_have_a_winner()
    {
        $this->withoutExceptionHandling();

        $this->signIn($john = create('App\User', ['name' => 'JohnDoe']));
        $jane = create('App\User', ['name' => 'JaneDoe']);

        $response = $this->json('post', route('api.initialize'), ['players' => [$john, $jane]]);
        $gameDetails = parseResponse($response);

        $game = Game::where('id', $gameDetails['id'])->first();

        $this->json('post', route('api.winner', [$game->id, $jane->id]))
            ->assertStatus(200);

        $game = $game->fresh();

        $this->assertEquals($game->winner->id, $jane->id);

        $this->assertTrue($game->isCompleted());
    }
}
