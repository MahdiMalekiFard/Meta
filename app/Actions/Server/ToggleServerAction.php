<?php

namespace App\Actions\Server;

use App\Models\Server;
use App\Repositories\Server\ServerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleServerAction
{
    use AsAction;

    public function __construct(private readonly ServerRepositoryInterface $repository)
    {
    }

    public function handle(Server $server): Server
    {
        return DB::transaction(function () use ($server) {
            return $this->repository->toggle($server);
        });
    }
}
