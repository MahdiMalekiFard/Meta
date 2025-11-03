<?php

namespace App\Actions\ActivationCode;

use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreActivationCodeAction
{
    use AsAction;

    public function __construct(private readonly ActivationCodeRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): ActivationCode
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
