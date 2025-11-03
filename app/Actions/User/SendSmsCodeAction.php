<?php

namespace App\Actions\User;

use App\Events\Auth\UserRegistered;
use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\SmsConfig\SmsConfigRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SendSmsCodeAction
{
    use AsAction;
    
    public function __construct(
        private readonly ActivationCodeRepositoryInterface $activationCodeRepository,
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }
    
    /**
     * @param int $codeLength
     *
     * @return int
     * @throws Exception
     */
    public function generateCode(int $codeLength = 4): int
    {
        $max = 10 ** $codeLength;
        $min = $max / 10 - 1;
        return random_int($min, $max);
    }
    
    /**
     * @throws Exception
     */
    public function handle(User $user): ActivationCode
    {
        $code = $this->generateCode();
        /** @var ActivationCode $model */
        $model = $this->activationCodeRepository->store([
            "code"      => 1111,
            "user_id"   => $user->id,
            "expire_at" => Carbon::now()->addMinutes(5),
        ]);
        // todo: send sms
        event(new UserRegistered($user, $model));
        return $model;
    }
}
