<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserAction
{
    use AsAction;
    
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): User
    {
        return DB::transaction(function () use ($payload) {
            /** @var User $user */
            $user = $this->repository->store($payload);
            $user->profile()->create([
                'user_id' => $user->id,
            ]);
            return $user;
        });
    }
}
