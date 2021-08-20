<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class rolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, $related)
    {
       return $user->owns($related) || auth()->user()->can('edit') ? true : false;
    }

    public function manage()
    {
       return auth()->user()->can('manage') ? true : false;
    }

    public function write()
    {
       return auth()->user()->can('write') ? true : false;
    }

    public function teach()
    {
       return auth()->user()->can('teach') ? true : false;
    }

    public function owner(User $user, $related)
    {
       return $user->owns($related);
    }
}
