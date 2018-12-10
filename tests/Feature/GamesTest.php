<?php

namespace Tests\Feature;

use App\Game;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesTest extends TestCase
{
    use RefreshDatabase;

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
