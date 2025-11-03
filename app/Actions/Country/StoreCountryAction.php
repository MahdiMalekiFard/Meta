<?php

namespace App\Actions\Country;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCountryAction
{
    use AsAction;
    
    public function __construct(private readonly CountryRepositoryInterface $repository)
    {
    }
    
    public function handle(array $payload): Country
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
