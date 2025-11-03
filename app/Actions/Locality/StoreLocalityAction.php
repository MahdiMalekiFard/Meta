<?php

namespace App\Actions\Locality;

use App\Models\Locality;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreLocalityAction
{
    use AsAction;

    public function __construct(private readonly LocalityRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Locality
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
