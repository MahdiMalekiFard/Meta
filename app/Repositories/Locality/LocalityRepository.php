<?php

namespace App\Repositories\Locality;

use App\Filters\FuzzyFilter;
use App\Models\Locality;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LocalityRepository extends BaseRepository implements LocalityRepositoryInterface
{
    public function __construct(Locality $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Locality
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
