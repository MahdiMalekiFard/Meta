<?php

namespace App\Actions\Module;

use App\Models\Module;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteModuleAction
{
    use AsAction;

    public function __construct(public readonly ModuleRepositoryInterface $repository)
    {
    }

    public function handle(Module $module): bool
    {
        return DB::transaction(function () use ($module) {
            return $this->repository->delete($module);
        });
    }
}
