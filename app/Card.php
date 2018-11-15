<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
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
        'active' => 'boolean'
    ];

    /**
     * The relationships to always eager load
     *
     * @var array
     */
    protected $with = ['rarity', 'power'];

    /**
     * A card has one rarity
     *
     * @return belongsTo
     */
    public function rarity()
    {
        return $this->belongsTo(Rarity::class);
    }

    /**
     * A card has one power
     *
     * @return belongsTo
     */
    public function power()
    {
        return $this->belongsTo(Power::class);
    }
}
