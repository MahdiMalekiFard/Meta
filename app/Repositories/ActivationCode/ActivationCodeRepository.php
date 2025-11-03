<?php

namespace App\Repositories\ActivationCode;

use App\Filters\FuzzyFilter;
use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivationCodeRepository extends BaseRepository implements ActivationCodeRepositoryInterface
{
    public function __construct(ActivationCode $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): ActivationCode
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
    
    public function checkCode(User $user, string $code): ActivationCode|null
    {
        return ActivationCode::query()
                             ->where('user_id', $user->id)
                             ->where('code', $code)
//                             ->active()
                             ->first();
    }
    
    public function useCode(ActivationCode $activationCode): ActivationCode
    {
        $activationCode->update(['used' => true]);
        return $activationCode;
    }
}
