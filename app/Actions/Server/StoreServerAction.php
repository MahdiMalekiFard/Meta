<?php

namespace App\Actions\Server;

use App\Models\Server;
use App\Repositories\Server\ServerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreServerAction
{
    use AsAction;

    public function __construct(private readonly ServerRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Server
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
