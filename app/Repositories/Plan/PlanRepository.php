<?php

namespace App\Repositories\Plan;

use App\Enums\PlanTypeEnum;
use App\Filters\FuzzyFilter;
use App\Models\Plan;
use App\Models\Service;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PlanRepository extends BaseRepository implements PlanRepositoryInterface
{
    public function __construct(Plan $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Plan
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

    public function getPlansByService(array $serviceIds): Collection
    {
        return $this->getModel()
                    ->where('planable_type', Service::class)
                    ->whereIn('planable_id', $serviceIds)
                    ->get();
    }

    public function getPlanByService(int $serviceId): Plan|null
    {
        return $this->getModel()
                    ->where('planable_type', Service::class)
                    ->where('planable_id', $serviceId)
                    ->first();
    }
}
