<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leave  $leave
     * @return mixed
     */
    public function view(User $user, Leave $leave)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leave  $leave
     * @return mixed
     */
    public function update(User $user, Leave $leave)
    {
        return $user->employee_id === $leave->employee_id || $leave->employee->boss_id === $user->employee_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leave  $leave
     * @return mixed
     */
    public function delete(User $user, Leave $leave)
    {
        return $user->employee_id === $leave->employee_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leave  $leave
     * @return mixed
     */
    public function restore(User $user, Leave $leave)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leave  $leave
     * @return mixed
     */
    public function forceDelete(User $user, Leave $leave)
    {
        //
    }
}
