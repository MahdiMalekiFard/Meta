<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    
    public function getModel(): User
    {
        return parent::getModel();
    }
    
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(User::class)
            ->defaultSort('-id')
            ->allowedFilters([
                AllowedFilter::custom('a_search',new AdvanceFilter())
            ]);
    }
    
    public function verifyUserMobile(User $user): User
    {
        $user->profile()->update(['mobile_verify_at' => now()]);
        return $user;
    }
    public function verifyUserEmailAddress(User $user): User
    {
        $user->profile()->update(['email_verify_at' => now()]);
        return $user;
    }
    
    public function generateToken(User $user): string
    {
        return $user->createToken('token')->plainTextToken;
    }
}
