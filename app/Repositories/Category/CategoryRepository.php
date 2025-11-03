<?php

namespace App\Repositories\Category;

use App\Filters\FuzzyFilter;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Category
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(Arr::get($payload, 'with', ['translations']))
                           ->withCount(Arr::get($payload, 'withCount', []))
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::scope('active')->default(Arr::get($payload, 'active'))->nullable(false),
                               
                               AllowedFilter::callback('with_active_service', function (Builder $query, $value) {
                                   $query->whereHas('services', function ($q) use ($value) {
                                       $q->active($value);
                                   });
                               })->default(Arr::get($payload, 'with_active_service'))->nullable(false),
                               
                               AllowedFilter::callback('with_active_estate', function (Builder $query, $value) {
                                   $query->whereHas('estates', function ($q) use ($value) {
                                       $q->active($value);
                                   });
                               })->default(Arr::get($payload, 'with_active_estate'))->nullable(false),
                               
                               AllowedFilter::custom('search', new FuzzyFilter(['name']))->default(Arr::get($payload, 'search'))->nullable(false),
                               
                               AllowedFilter::custom('a_search', new AdvanceFilter())->default(Arr::get($payload, 'a_search', []))->nullable(false),
                           ]);
    }
}
