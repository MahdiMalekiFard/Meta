<?php

namespace App\Repositories\Ticket;

use App\Enums\PermissionsEnum;
use App\Filters\FuzzyFilter;
use App\Models\Ticket;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Ticket
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['user','lastMessage','lastMessage.media'])
                           ->when(!auth()->user()?->hasAnyPermission([PermissionsEnum::ADMIN->value,PermissionsEnum::TICKET_ALL->value]), function (Builder $query) {
                               $query->where('user_id', auth()->id());
                           })
                           ->defaultSort('-updated_at')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter()),
                           ]);
    }
}
