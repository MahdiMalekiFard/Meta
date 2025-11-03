<?php

namespace App\Actions\Profile;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProfileAction
{
    use AsAction;

    public function __construct(private readonly ProfileRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Profile
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
