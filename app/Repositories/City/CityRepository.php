<?php

namespace App\Repositories\City;

use App\Filters\FuzzyFilter;
use App\Models\City;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use App\Sort\RelationCountSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): City
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        $queryParams = array_merge(request()?->all(), [
            'sort' => Arr::get($payload, 'sort', request()?->input('sort', '-id')),
        ]);
        return QueryBuilder::for($this->getModel(), new Request($queryParams))
                           ->with(Arr::get($payload, 'with', ['translations']))
                           ->withCount(Arr::get($payload, 'withCount', []))
                           ->defaultSort('-id')
                           ->allowedSorts([
                               'id',
                               AllowedSort::custom('estates_count', new RelationCountSort(), 'estates'),
                           ])
                           ->allowedFilters([
                               AllowedFilter::callback('with_active_service', function (Builder $query, $value) {
                                   $query->whereHas('services', function ($q) {
                                       $q->active(true);
                                   });
                               })->default(Arr::get($payload, 'with_active_service'))->nullable(false),
                               AllowedFilter::callback('with_active_estate', function (Builder $query, $value) {
                                   $query->whereHas('estates', function ($q) {
                                       $q->active(true);
                                   });
                               })->default(Arr::get($payload, 'with_active_estate'))->nullable(false),
                               AllowedFilter::custom('search', new FuzzyFilter(['name'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter()),
                           ]);
    }
}
