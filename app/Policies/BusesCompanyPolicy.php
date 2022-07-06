<?php

namespace App\Policies;

use App\Models\BusesCompany;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusesCompanyPolicy
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
     * @param  \App\Models\BusesCompany  $busesCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BusesCompany $busesCompany)
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
     * @param  \App\Models\BusesCompany  $busesCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BusesCompany $busesCompany)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusesCompany  $busesCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BusesCompany $busesCompany)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusesCompany  $busesCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BusesCompany $busesCompany)
    {
         return $user->type() == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusesCompany  $busesCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BusesCompany $busesCompany)
    {
         return $user->type() == 'admin';
    }
}
