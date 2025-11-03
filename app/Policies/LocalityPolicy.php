<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Locality;
use App\Models\User;

class LocalityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_ALL->value, PermissionsEnum::LOCALITY_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_ALL->value, PermissionsEnum::LOCALITY_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_ALL->value, PermissionsEnum::LOCALITY_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_ALL->value, PermissionsEnum::LOCALITY_UPDATE->value) || $user->id === $locality->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_ALL->value, PermissionsEnum::LOCALITY_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::LOCALITY_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
