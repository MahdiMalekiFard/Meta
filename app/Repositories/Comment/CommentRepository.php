<?php

namespace App\Repositories\Comment;

use App\Enums\PermissionsEnum;
use App\Filters\ActiveFilter;
use App\Filters\FuzzyFilter;
use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): Comment
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
                           ->with(['commentable'])
                           ->when(!auth()->user()?->hasAnyPermission([PermissionsEnum::COMMENT_ALL->value]), function (Builder $query) {
                               $query->where('user_id', auth()->id());
                           })
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('active', new ActiveFilter())->default(Arr::get($payload, 'active'))->nullable(false),
                               AllowedFilter::custom('search', new FuzzyFilter(['comment']))->default(Arr::get($payload, 'search'))->nullable(false),
                               AllowedFilter::custom('a_search', new AdvanceFilter())->default(Arr::get($payload, 'a_search', []))->nullable(false),
                           ]);
    }
}
