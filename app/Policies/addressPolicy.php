<?php

namespace App\Policies;

use App\Models\User;
use App\Models\address;
use Illuminate\Auth\Access\HandlesAuthorization;

class addressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, address $address)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, address $address)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, address $address)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, address $address)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\address  $address
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, address $address)
    {
         return $user->type() == 'admin';
    }
}