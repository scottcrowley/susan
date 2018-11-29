<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A rarity belongs to many cards
     *
     * @return hasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
