<?php

namespace App\Actions\Module;

use App\Models\Module;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreModuleAction
{
    use AsAction;

    public function __construct(private readonly ModuleRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Module
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
