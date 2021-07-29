<?php

namespace App\Policies;

use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PatientPolicy.
 * For simplicity, the policy is currently set to return true to allow all actions, however it a real world application
 * we would provide a user permissions table to determine the actions each user can take.
 */
class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all patients.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
//        return $user->can('view patients') ?? false;
    }

    /**
     * Determine whether the user can view the patient.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        return true;
//        return $user->can('view patients') ?? false;
    }

    /**
     * Determine whether the user can create patients.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
//        return $user->can('create patients') ?? false;
    }

    /**
     * Determine whether the user can update the patient.
     *
     * @param User $user
     *
     * @return bool
     */
    public function update(User $user): bool
    {
        return true;
//        return $user->can('update patients') ?? false;
    }

    /**
     * Determine whether the user can delete the patient.
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user): bool
    {
        return true;
//        return $user->can('delete patients') ?? false;
    }

    /**
     * Determine whether the user can restore the patient.
     *
     * @param User $user
     *
     * @return bool
     * @throws Exception
     */
    public function restore(User $user): bool
    {
        return true;
//        return $user->hasAllPermissions(['create patients|update patients|delete patients']) ?? false;
    }

    /**
     * Determine whether the user can permanently delete the patient.
     *
     * @param User $user
     *
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return true;
//        return $user->can('delete patients') ?? false;
    }
}
