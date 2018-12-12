<?php

namespace App\Http\Controllers;

use App\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::where('archived', false)->latest()->get();

        return view('games.index', compact('games'));
    }
}
