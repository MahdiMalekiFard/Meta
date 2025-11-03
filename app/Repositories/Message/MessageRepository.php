<?php

namespace App\Repositories\Message;

use App\Filters\FuzzyFilter;
use App\Models\Message;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Message
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['media','user'])
                           ->when(Arr::get($payload, 'ticket_id'), function (Builder $query) use ($payload) {
                                $query->where('ticket_id', Arr::get($payload, 'ticket_id'));
                           })
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter()),
                           ]);
    }
}
