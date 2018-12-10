<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;

class GamesController extends Controller
{
    public function store()
    {
        $min = config('susan.min_players');
        $max = config('susan.max_players');

        $data = request()->validate([
            'players' => 'required|min:'.$min.'|max:'.$max
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

    /**
     * mark a game as completed
     *
     * @param Game $game
     * @return void
     */
    public function complete(Game $game)
    {
        $game->update(['completed' => true]);

        if (request()->wantsJson()) {
            return response($game, 200);
        }

        return back();
    }

    /**
     * mark a game as archived
     *
     * @param Game $game
     * @return void
     */
    public function archive(Game $game)
    {
        $game->update(['archived' => true]);

        if (request()->wantsJson()) {
            return response($game, 200);
        }

        return back();
    }

    public function initializeGame($data)
    {
        $game = [
            'rules' => [
                'min_players' => config('susan.min_players'),
                'max_players' => config('susan.max_players'),
                'starting_card_count' => config('susan.starting_card_count')
            ],
            'players' => []
        ];

        foreach ($data['players'] as $player) {
            $game['players'][$player['id']] = [
                'name' => $player['name'],
                'starting_cards' => []
            ];
        }

        return $game;
    }
}
