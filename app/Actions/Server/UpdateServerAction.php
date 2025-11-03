<?php

namespace App\Actions\Server;

use App\Enums\PermissionEnum;
use App\Models\Server;
use App\Repositories\Server\ServerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateServerAction
{
    use AsAction;

    public function __construct(private readonly ServerRepositoryInterface $repository)
    {
    }


    /**
     * @param Server                                          $server
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Server
     */
    public function handle(Server $server, array $payload): Server
    {
        return DB::transaction(function () use ($server, $payload) {
            $server->update($payload);
            return $server;
        });
    }
}
