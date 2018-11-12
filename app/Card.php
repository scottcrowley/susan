<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function rarity()
    {
        return $this->hasOne(Rarity::class);
    }
}
