<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A gameuser belongs to one player
     *
     * @return belongsTo
     */
    public function player()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A gameuser belongs to one game
     *
     * @return belongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
