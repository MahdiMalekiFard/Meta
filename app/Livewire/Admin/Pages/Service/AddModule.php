<?php

namespace App\Livewire\Admin\Pages\Service;

use App\Enums\PlanTypeEnum;
use App\Models\Module;
use App\Models\Service;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class AddModule extends Component
{
    public Service    $service;
    public Collection $modules;
    
    private ModuleRepositoryInterface $moduleRepository;
    
    public function boot(): void
    {
        $this->moduleRepository = app(ModuleRepositoryInterface::class);
    }
    
    public function mount(Service $service): void
    {
        $this->service = $service;
        $this->modules = collect();
        $service->modules->groupBy('key')->each(function (Collection $modulesCollection, $key) {
            $module = $this->moduleRepository->find($key, 'key', firstOrFail: true);
            $data = [
                'key'         => $key,
                'limitable'   => false,
                'editable'    => true,
                'plan_type_1' => 0,
                'plan_type_2' => 0,
                'plan_type_3' => 0,
                'plan_type_4' => 0,
            ];
            foreach ($modulesCollection as $item) {
                $data['sort'] = $item->pivot->order;
                $data['limitable'] = $module->key->limitable();
                if ($item->pivot->plan_type === PlanTypeEnum::TYPE1->value) {
                    $data['plan_type_1'] = $item->pivot->limit;
                }
                if ($item->pivot->plan_type === PlanTypeEnum::TYPE2->value) {
                    $data['plan_type_2'] = $item->pivot->limit;
                }
                if ($item->pivot->plan_type === PlanTypeEnum::TYPE3->value) {
                    $data['plan_type_3'] = $item->pivot->limit;
                }
                if ($item->pivot->plan_type === PlanTypeEnum::TYPE4->value) {
                    $data['plan_type_4'] = $item->pivot->limit;
                }
            }
            
            $this->modules->push($data);
        });

//        dd($this->modules->toArray());
    }
    
    public function addModule(): void
    {
//        $this->modules = $this->modules->where('editable', true)->map(function (array $module, int $index) {
//            $module['editable'] = false;
//            return $module;
//        });
        
        $this->modules->push([
            'key'         => null,
            'sort'        => 1,
            'editable'    => true,
            'limitable'   => false,
            'plan_type_1' => null,
            'plan_type_2' => null,
            'plan_type_3' => null,
            'plan_type_4' => null,
        ]);
    }
    
    public function updatedModules($value): void
    {
        $this->resetErrorBag('modules.*');
        $dupes = $this->modules->groupBy('key')->filter(function (Collection $groups) {
            return $groups->count() > 1;
        });
        if ($dupes->isNotEmpty()) {
            foreach (array_keys($dupes->toArray()) as $arrayKey) {
                $this->modules->whereIn('key', $arrayKey)->each(function ($module, $key) {
                    $this->addError('modules[' . $key . '][key]', $module['key'] . ' is duplicated');
                });
            }
        }
        $this->modules = $this->modules->map(function ($item, $key) {
            $module = $this->moduleRepository->find($item['key'], 'key', firstOrFail: true);
            $item['limitable'] = $module->key->limitable();
            return $item;
        });
    }
    
    public function removeRow($index): void
    {
        $this->modules->forget($index);
    }
    
    public function enableEdit($index): void
    {
        $this->modules->each(function ($module, $key) use ($index) {
            if ($key == $index) {
                $this->modules[$key]['editable'] = true;
            } else {
                $this->modules[$key]['editable'] = false;
            }
        });
    }
    
    public function render(): View
    {
        return view('livewire.admin.pages.service.add-module');
    }
}
