<?php

namespace App\Filters;

use App\User;

class CardFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'active', 'inactive'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function by($name)
    {
        $user = User::where('name', $name)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function active()
    {
        return $this->builder->whereActive(true);
    }

    /**
     * Filter the query according to those that are unanswered.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function inactive()
    {
        return $this->builder->whereActive(false);
    }
}
