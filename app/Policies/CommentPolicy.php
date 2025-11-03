<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
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
    public function view(User $user, Comment $comment): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::COMMENT_ALL->value, PermissionsEnum::COMMENT_SHOW->value);
        
    }
    
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::COMMENT_ALL->value, PermissionsEnum::COMMENT_STORE->value);
        
    }
    
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::COMMENT_ALL->value, PermissionsEnum::COMMENT_UPDATE->value) || $user->id === $comment->user_id;
        
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return
            $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::COMMENT_ALL->value, PermissionsEnum::COMMENT_DELETE->value)
            ||
            $comment->user_id === $user->id;
        
    }
    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comment $comment): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::COMMENT_RESTORE->value, PermissionsEnum::ADMIN->value);
        
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ADMIN->value, PermissionsEnum::ADMIN->value);
        
    }
}
