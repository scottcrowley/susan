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
     * A game belongs to one creator
     *
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
