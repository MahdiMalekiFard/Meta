<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;
use RuntimeException;

class LoginAction
{
    use AsAction;
    
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }
    
    /**
     * Login ....
     *
     * @param array $payload
     *
     * @return User|null
     */
    public function handle(array $payload = []): ?User
    {
        $user = $this->userRepository->find($payload['email'], 'email');
        
        if ($user) {
            if (!$user->status) {
                throw new RuntimeException(__('auth.you_are_not_allowed_to_enter_the_system_please_use_the_contact_us_section'));
            }
            if (Hash::check(Arr::get($payload, 'password'), $user->password)) {
                return $user;
            }
            throw new RuntimeException(__('authentication.No_authenticated_user_detected'));
        }
        throw new RuntimeException(__('auth.username_or_password_is_incorrect'));
    }
}
