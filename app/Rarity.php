<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    /**
     * A rarity belongs to many cards
     *
     * @return belongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
