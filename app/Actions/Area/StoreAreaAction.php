<?php

namespace App\Actions\Area;

use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAreaAction
{
    use AsAction;

    public function __construct(private readonly AreaRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Area
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
