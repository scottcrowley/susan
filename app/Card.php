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
     * Query scope to filter cards by a given username
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeBy($query)
    {
        $user = User::whereName(request('by'))->firstOrFail();

        return $query->where('user_id', $user->id);
    }
}
