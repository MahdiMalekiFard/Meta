<?php

namespace App\Repositories\PlanPricing;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Filters\FuzzyFilter;
use App\Models\PlanPricing;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PlanPricingRepository extends BaseRepository implements PlanPricingRepositoryInterface
{
    public function __construct(PlanPricing $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): PlanPricing
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
    
    public function getPricingByPlan(int $planId, PlanTypeEnum $type, PlanMonthEnum $month): PlanPricing|null
    {
        return $this->getModel()
                    ->where('type', $type->value)
                    ->where('month', $month->value)
                    ->where('plan_id', $planId)
                    ->first();
    }
}
