<?php

namespace App\Policies;

use App\Models\FormMassage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormMassagePolicy
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
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FormMassage  $formMassage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FormMassage $formMassage)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FormMassage  $formMassage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FormMassage $formMassage)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FormMassage  $formMassage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FormMassage $formMassage)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FormMassage  $formMassage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FormMassage $formMassage)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FormMassage  $formMassage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FormMassage $formMassage)
    {
        return ($user->type() == 'admin' || $user->type() == 'website_admin') ;
    }
}
