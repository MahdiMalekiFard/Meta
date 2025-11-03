<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_ALL->value, PermissionsEnum::REPORT_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Report $report): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_ALL->value, PermissionsEnum::REPORT_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_ALL->value, PermissionsEnum::REPORT_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Report $report): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_ALL->value, PermissionsEnum::REPORT_UPDATE->value) || $user->id === $report->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Report $report): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_ALL->value, PermissionsEnum::REPORT_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Report $report): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Report $report): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
