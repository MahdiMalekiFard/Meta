<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Like;
use App\Models\User;

class LikePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Like $like): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LIKE_ALL->value, PermissionsEnum::LIKE_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LIKE_ALL->value, PermissionsEnum::LIKE_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Like $like): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LIKE_ALL->value, PermissionsEnum::LIKE_UPDATE->value) || $user->id === $like->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Like $like): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LIKE_ALL->value, PermissionsEnum::LIKE_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Like $like): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LIKE_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Like $like): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
