<?php

namespace App\Actions\Server;

use App\Models\Server;
use App\Repositories\Server\ServerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteServerAction
{
    use AsAction;

    public function __construct(public readonly ServerRepositoryInterface $repository)
    {
    }

    public function handle(Server $server): bool
    {
        return DB::transaction(function () use ($server) {
            return $this->repository->delete($server);
        });
    }
}
