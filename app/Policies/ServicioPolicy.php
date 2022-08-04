<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Servicio;
use App\Models\User;

class ServicioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ( $user->hasRole([Id del rol]) || $user->getAllPermissions()->whereIn('id', [Ids de los permisos])->count() > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servicio  $servicio
     * @return mixed
     */
    public function view(User $user, Servicio $servicio)
    {
        if ( $user->hasRole([Id del rol]) || $user->getAllPermissions()->whereIn('id', [Ids de los permisos])->count() > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ( $user->hasRole([Id del rol]) || $user->getAllPermissions()->whereIn('id', [Ids de los permisos])->count() > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servicio  $servicio
     * @return mixed
     */
    public function update(User $user, Servicio $servicio)
    {
        if ( $user->hasRole([Id del rol]) || $user->getAllPermissions()->whereIn('id', [Ids de los permisos])->count() > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servicio  $servicio
     * @return mixed
     */
    public function delete(User $user, Servicio $servicio)
    {
        if ( $user->hasRole([Id del rol]) || $user->getAllPermissions()->whereIn('id', [Ids de los permisos])->count() > 0 ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servicio  $servicio
     * @return mixed
     */
    public function restore(User $user, Servicio $servicio)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Servicio  $servicio
     * @return mixed
     */
    public function forceDelete(User $user, Servicio $servicio)
    {
        //
    }
}
