<?php

namespace App\Repositories\Module;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Filters\FuzzyFilter;
use App\Models\Module;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function __construct(Module $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Module
   {
       return parent::getModel();
   }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with([])
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name']))->default(Arr::get($payload, 'search'))->nullable(false),
                               AllowedFilter::custom('a_search', new AdvanceFilter())->default(Arr::get($payload, 'a_search', []))->nullable(false),
                           ]);
    }

    public function getModulesByServiceAndTypeAndMonth(int $serviceId, PlanTypeEnum $type, PlanMonthEnum $month): Collection|array
    {
        return $this->query()
                    ->where('service_id', $serviceId)
                    ->where('type', $type->value)
                    ->where('month', $month->value)
                    ->get();
    }
}
