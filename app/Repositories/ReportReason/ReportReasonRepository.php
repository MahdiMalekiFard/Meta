<?php

namespace App\Repositories\ReportReason;

use App\Filters\FuzzyFilter;
use App\Models\ReportReason;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReportReasonRepository extends BaseRepository implements ReportReasonRepositoryInterface
{
    public function __construct(ReportReason $model)
    {
        parent::__construct($model);
    }

   public function getModel(): ReportReason
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
