<?php

namespace App\Repositories\Area;

use App\Filters\FuzzyFilter;
use App\Models\Area;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AreaRepository extends BaseRepository implements AreaRepositoryInterface
{
    public function __construct(Area $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Area
   {
       return parent::getModel();
   }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with([])
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter()),
                           ]);
    }
}
