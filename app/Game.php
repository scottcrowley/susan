<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['winner', 'players'];

    /**
     * attributes that should be cast to native values
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
        'archived' => 'boolean',
    ];

    /**
     * A game belongs to one creator
     *
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * getter for complete attribute
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * getter for complete attribute
     *
     * @return bool
     */
    public function isArchived()
    {
        return $this->archived;
    }

    /**
     * A game belongs to one winner
     *
     * @return belongsTo
     */
    public function winner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A game can have many players.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(GameUser::class, 'game_id');
    }

    /**
     * addPlayer
     *
     * @param int $userId
     * @return void
     */
    public function addPlayer($userId)
    {
        $this->players()->create([
            'user_id' => $userId
        ]);
    }
}
