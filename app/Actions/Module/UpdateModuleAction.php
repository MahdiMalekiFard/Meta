<?php

namespace App\Actions\Module;

use App\Enums\PermissionEnum;
use App\Models\Module;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateModuleAction
{
    use AsAction;

    public function __construct(private readonly ModuleRepositoryInterface $repository)
    {
    }


    /**
     * @param Module                                          $module
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Module
     */
    public function handle(Module $module, array $payload): Module
    {
        return DB::transaction(function () use ($module, $payload) {
            $module->update($payload);
            return $module;
        });
    }
}
