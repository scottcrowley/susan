<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_game_can_be_initialized()
    {
        $this->withoutExceptionHandling();

        //Given a game has started with 2 players
        $this->signIn($john = create('App\User', ['name' => 'John Doe']));
        $jane = create('App\User', ['name' => 'Jane Doe']);

        //A new game is requested
        $response = $this->json('post', route('api.initialize'), ['players' => [$john, $jane]]);

        //A new game row exists in the database and the appropriate json response is received
        $game = [
            'initialized_by' => $john->id,
            'max_players' => config('susan.max_players'),
            'rules' => [
                'starting_card_count' => config('susan.starting_card_count')
            ],
            'players' => [
                snake_case($john->name) => [
                    'id' => $john->id,
                    'starting_cards' => [
                    ],
                    'won' => false
                ],
                snake_case($jane->name) => [
                    'id' => $jane->id,
                    'starting_cards' => [
                    ],
                    'won' => false
                ]
            ]
        ];

        $game = json_encode($game);

        $this->assertEquals($game, $response->getContent());
    }

    // /** @test */
    // public function playerone_card_can_do_damage_to_playertwo_card()
    // {
    //     //
    // }
}
