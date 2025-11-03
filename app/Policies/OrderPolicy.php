<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ORDER_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ORDER_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ORDER_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ORDER_UPDATE->value) || $user->id === $order->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_ALL->value, PermissionsEnum::ORDER_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ORDER_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
