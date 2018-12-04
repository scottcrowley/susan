<?php

namespace App;

use App\Filters\CardFilters;
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
     * A card belongs to one creator
     *
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    /**
     * Apply all relevant card filters.
     *
     * @param  Builder       $query
     * @param  CardFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, CardFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * getter for whether the card is active or not
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Make the current card inactive
     *
     * @return this
     */
    public function makeInactive()
    {
        if ($this->active) {
            $this->active = false;
            $this->save();
        }

        return $this;
    }

    /**
     * Make the current card active
     *
     * @return this
     */
    public function makeActive()
    {
        if (! $this->active) {
            $this->active = true;
            $this->save();
        }

        return $this;
    }
}
