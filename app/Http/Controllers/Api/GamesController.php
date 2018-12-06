<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;

class GamesController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'players' => 'required'
        ]);

        $game = json_encode($this->initializeGame($data));

        $newGame = Game::create([
            'user_id' => auth()->id(),
            'meta' => $game
        ]);

        if (request()->wantsJson()) {
            return $game;
        }

        return back();
    }

    public function initializeGame($data)
    {
        $game = [
            'initialized_by' => auth()->id(),
            'max_players' => config('susan.max_players'),
            'rules' => [
                'starting_card_count' => config('susan.starting_card_count')
            ],
            'players' => []
        ];

        foreach ($data['players'] as $player) {
            $game['players'][snake_case($player['name'])] = [
                'id' => $player['id'],
                'starting_cards' => [],
                'won' => false
            ];
        }

        return $game;
    }
}
