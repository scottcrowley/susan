<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function createGame($attributes = [], $playersCount = 2)
{
    $game = factory('App\Game')->create($attributes);

    $gameName = $creatorName = $game->creator->name;

    $users = factory('App\User', $playersCount)
        ->create()
        ->each(function ($user) use ($game, &$gameName, $creatorName) {
            if ($user->name != $creatorName) {
                $gameName .= ' vs. '.$user->name;

                $game->addPlayer($user->id);
            }
        });
    $now = \Carbon\Carbon::now()->format('D, M jS, Y h:i A');
    $gameName = $gameName.' - '.$now;

    $game->update(['name' => $gameName]);

    return $game->fresh();
}

function parseResponse($response)
{
    return json_decode($response->getContent(), true);
}
