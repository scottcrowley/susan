<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\User;
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

        $players = $data['players'];

        $newGame = Game::create([
            'user_id' => auth()->id(),
            'name' => $this->calculateName($players)
        ]);

        foreach ($players as $player) {
            $newGame->addPlayer($player['id']);
        }

        if (request()->wantsJson()) {
            return $newGame->fresh();
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
            return $game;
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

    /**
     * mark a game won by a given player
     *
     * @param Game $game
     * @param User $player
     * @return void
     */
    public function winner(Game $game, User $player)
    {
        $game->update(['winner_id' => $player->id, 'completed' => true]);

        if (request()->wantsJson()) {
            return response($game, 200);
        }

        return back();
    }

    public function calculateName($players)
    {
        $name = $username = auth()->user()->name;

        foreach ($players as $player) {
            if ($player['name'] == $username) {
                continue;
            }
            $name .= ' vs. '.$player['name'];
        }

        $now = \Carbon\Carbon::now()->format('D, M jS, Y h:i A');
        return $name.' - '.$now;
    }
}
