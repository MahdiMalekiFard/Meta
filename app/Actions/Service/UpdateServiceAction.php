<?php

namespace App\Actions\Service;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Enums\PlanTypeEnum;
use App\Models\Module;
use App\Models\Service;
use App\Repositories\Module\ModuleRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateServiceAction
{
    use AsAction;
    
    private Collection $modules;
    
    public function __construct(
        private readonly ServiceRepositoryInterface $repository,
        private readonly FileService $fileService,
        private readonly ModuleRepositoryInterface $moduleRepository,
    )
    {
        $this->modules = collect();
    }
    
    /**
     * @param Service                                       $service
     * @param array{name:string,mobile:string,email:string} $payload
     *
     * @return Service
     */
    public function handle(Service $service, array $payload): Service
    {
        return DB::transaction(function () use ($service, $payload) {
            $service->update($payload);
            
            /** @var array{key:string,sort:string,plan_type_1:string,plan_type_2:string,plan_type_3:string,plan_type_4:string,} $item */
            foreach (Arr::get($payload, 'modules', []) as $item) {
                $module = $this->moduleRepository->find($item['key'], 'key', firstOrFail: true);
                $this->addToModule($module, $item);
            }
            
            $service->modules()->sync([]);
            foreach ($this->modules as $module) {
                $service->modules()->attach($module['module_id'], [
                    'plan_type' => $module['plan_type'],
                    'limit'     => $module['limit'],
                    'order'     => $module['order'],
                ]);
            }
            
            SyncTranslationAction::run($service);
            $this->fileService->addMedia($service);
            
            return $service;
        });
    }
    
    private function addToModule(Module $module, array $item): void
    {
        foreach (PlanTypeEnum::cases() as $case) {
            if (Arr::get($item, 'plan_type_' . $case->value, 0)) {
                $this->modules->push([
                    'module_id' => $module->id,
                    'plan_type' => $case->value,
                    'limit'     => Arr::get($item, 'plan_type_' . $case->value, 1),
                    'order'     => Arr::get($item, 'sort', 1),
                ]);
            }
        }
    }
}
