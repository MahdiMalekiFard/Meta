<?php

namespace App\Actions\ActivationCode;

use App\Enums\PermissionEnum;
use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateActivationCodeAction
{
    use AsAction;

    public function __construct(private readonly ActivationCodeRepositoryInterface $repository)
    {
    }


    /**
     * @param ActivationCode                                          $activationCode
     * @param array{name:string,mobile:string,email:string} $payload
     * @return ActivationCode
     */
    public function handle(ActivationCode $activationCode, array $payload): ActivationCode
    {
        return DB::transaction(function () use ($activationCode, $payload) {
            $activationCode->update($payload);
            return $activationCode;
        });
    }
}
