<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\ActivationCode;
use App\Models\User;

class ActivationCodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_ALL->value, PermissionsEnum::ACTIVATION_CODE_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_ALL->value, PermissionsEnum::ACTIVATION_CODE_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_ALL->value, PermissionsEnum::ACTIVATION_CODE_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_ALL->value, PermissionsEnum::ACTIVATION_CODE_UPDATE->value) || $user->id === $activationCode->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_ALL->value, PermissionsEnum::ACTIVATION_CODE_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ACTIVATION_CODE_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
