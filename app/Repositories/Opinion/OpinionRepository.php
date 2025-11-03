<?php

namespace App\Repositories\Opinion;

use App\Filters\FuzzyFilter;
use App\Models\Opinion;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OpinionRepository extends BaseRepository implements OpinionRepositoryInterface
{
    public function __construct(Opinion $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Opinion
   {
       return parent::getModel();
   }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['translations'])
                           ->defaultSort('-id')
                           ->allowedFilters([
//                               AllowedFilter::scope('active'),
                               AllowedFilter::custom('search', new FuzzyFilter(['name']))->nullable(false),
                               AllowedFilter::custom('a_search', new AdvanceFilter())->nullable(false),
                           ]);
    }
}
