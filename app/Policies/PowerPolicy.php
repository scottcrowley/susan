<?php

namespace App\Policies;

use App\User;
use App\Power;
use Illuminate\Auth\Access\HandlesAuthorization;

class PowerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the power.
     *
     * @param  \App\User  $user
     * @param  \App\Power  $power
     * @return mixed
     */
    public function update(User $user, Power $power)
    {
        return $user->id == $power->user_id;
    }
}
