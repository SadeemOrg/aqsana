<?php

namespace App\Policies;

use App\Models\User;
use App\Models\events;
use Illuminate\Auth\Access\HandlesAuthorization;

class eventsPolicy
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
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\events  $events
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, events $events)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\events  $events
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, events $events)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\events  $events
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, events $events)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\events  $events
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, events $events)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\events  $events
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, events $events)
    {
          return ($user->type() == 'admin' ||$user->type() == 'website_admin'  ) ;
    }
}