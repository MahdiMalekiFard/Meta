<?php

namespace App\Repositories\Report;

use App\Filters\FuzzyFilter;
use App\Models\Report;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Report
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
