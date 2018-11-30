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
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * A rarity belongs to many cards
     *
     * @return hasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * getter for whether the power is active or not
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Make the current power inactive
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
     * Make the current power active
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
