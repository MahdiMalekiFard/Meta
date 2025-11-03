<?php

namespace App\Repositories\Service;

use App\Filters\FuzzyFilter;
use App\Models\Service;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AColumnBuilder;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Service
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(Arr::get($payload, 'with', ['translations']))
                           ->defaultSort(Arr::get($payload, 'sort', '-id'))
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name']))->default(Arr::get($payload, 'search'))->nullable(false),
                               AllowedFilter::custom('a_search', new AdvanceFilter())->default(Arr::get($payload, 'a_search', []))->nullable(false),
                           ]);
    }
    
    public function related(Service $service): Collection
    {
        return $this->query([
            'a_search' => [
                AColumnBuilder::new('category_id', $service->categories()->pluck('id')->toArray())
                              ->setOperator('in')
                              ->generate(),
            ],
        ])->limit(10)->get();
    }
}
