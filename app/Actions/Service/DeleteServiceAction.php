<?php

namespace App\Actions\Service;

use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteServiceAction
{
    use AsAction;

    public function __construct(public readonly ServiceRepositoryInterface $repository)
    {
    }

    public function handle(Service $service): bool
    {
        return DB::transaction(function () use ($service) {
            return $this->repository->delete($service);
        });
    }
}
