<?php

namespace App\Repositories\Order;

use App\Filters\FuzzyFilter;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Order
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
}
