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
     * attributes that should be cast to native values
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'json',
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
        return $this->belongsTo(User::class);
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
}
