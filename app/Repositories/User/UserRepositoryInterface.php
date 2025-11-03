<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): User;
    
    public function verifyUserMobile(User $user):User;
    public function verifyUserEmailAddress(User $user):User;
    
    public function generateToken(User $user): string;
}
