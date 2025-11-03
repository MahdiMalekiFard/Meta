<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\PlanPricing;
use App\Models\User;

class PlanPricingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_ALL->value, PermissionsEnum::PLANPRICING_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PlanPricing $planPricing): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_ALL->value, PermissionsEnum::PLANPRICING_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_ALL->value, PermissionsEnum::PLANPRICING_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PlanPricing $planPricing): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_ALL->value, PermissionsEnum::PLANPRICING_UPDATE->value) || $user->id === $planPricing->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PlanPricing $planPricing): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_ALL->value, PermissionsEnum::PLANPRICING_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PlanPricing $planPricing): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::PLANPRICING_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PlanPricing $planPricing): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
