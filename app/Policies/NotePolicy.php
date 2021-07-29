<?php

namespace App\Policies;

use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NotePolicy.
 * For simplicity, the policy is currently set to return true to allow all actions, however it a real world application
 * we would provide a user permissions table to determine the actions each user can take.
 */
class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all notes.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
//        return $user->can('view notes') ?? false;
    }


    /**
     * Determine whether the user can view the note.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        return true;
//        return $user->can('view notes') ?? false;
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
//        return $user->can('create notes') ?? false;
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param User $user
     *
     * @return bool
     */
    public function update(User $user): bool
    {
        return true;
//        return $user->can('update notes') ?? false;
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user): bool
    {
        return true;
//        return $user->can('delete notes') ?? false;
    }

    /**
     * Determine whether the user can restore the note.
     *
     * @param User $user
     *
     * @return bool
     * @throws Exception
     */
    public function restore(User $user): bool
    {
        return true;
//        return $user->hasAllPermissions(['create notes|update notes|delete notes']) ?? false;
    }

    /**
     * Determine whether the user can permanently delete the note.
     *
     * @param User $user
     *
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return true;
//        return $user->can('delete notes') ?? false;
    }
}
