<?php

namespace App\Repositories\Subscription;

use App\Filters\FuzzyFilter;
use App\Models\Subscription;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SubscriptionRepository extends BaseRepository implements SubscriptionRepositoryInterface
{
    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Subscription
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
