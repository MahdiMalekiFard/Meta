<?php

namespace App\Repositories\Like;

use App\Enums\PermissionsEnum;
use App\Filters\FuzzyFilter;
use App\Models\Like;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function __construct(Like $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Like
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['user', 'likeable'])
                           ->when(!auth()->user()?->hasAnyPermission([PermissionsEnum::LIKE_ALL->value]), function (Builder $query) {
                               $query->where('user_id', auth()->id());
                           })
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['name'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter()),
                           ]);
    }
}
