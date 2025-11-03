<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\ReportReason;
use App\Models\User;

class ReportReasonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_ALL->value, PermissionsEnum::REPORT_REASON_INDEX->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ReportReason $reportReason): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_ALL->value, PermissionsEnum::REPORT_REASON_SHOW->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_ALL->value, PermissionsEnum::REPORT_REASON_STORE->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ReportReason $reportReason): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_ALL->value, PermissionsEnum::REPORT_REASON_UPDATE->value) || $user->id === $reportReason->id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ReportReason $reportReason): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_ALL->value, PermissionsEnum::REPORT_REASON_DELETE->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ReportReason $reportReason): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::REPORT_REASON_RESTORE->value, PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ReportReason $reportReason): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value,PermissionsEnum::ADMIN->value);

    }
}
