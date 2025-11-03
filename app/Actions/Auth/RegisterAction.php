<?php

namespace App\Actions\Auth;

use App\Actions\User\StoreUserAction;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Mail\MailService;
use Lorisleiva\Actions\Concerns\AsAction;
use RuntimeException;

class RegisterAction
{
    use AsAction;
    
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MailService $mailService,
        private readonly StoreUserAction $storeUserAction,
    )
    {
    }
    
    /**
     * Register ....
     *
     * @param array $payload
     *
     * @return void
     */
    public function handle(array $payload = [])
    {
        $user = $this->userRepository->find($payload['email'], 'email');
        
        if ($user) {
            return redirect()->back()->withToastError(__('auth.check_email'));
        }
        
        $user = $this->storeUserAction->handle($payload);
        if ($user) {
            $this->mailService->sendVerificationCode($user);
            return redirect(route('auth.verify-code-view', ['user_id' => $user->id]))
                ->withToastSuccess(__('auth.verification_link_sent'));
        }
        abort(500, 'Something went wrong');
    }
}
