<?php

namespace App\Actions\Province;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Province;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProvinceAction
{
    use AsAction;
    
    public function __construct(
        private readonly ProvinceRepositoryInterface $repository,
        private readonly CountryRepositoryInterface $countryRepository
    )
    {
    }
    
    public function handle(array $payload): Province
    {
        return DB::transaction(function () use ($payload) {
            
            $country = $this->countryRepository->find($payload['country_uuid'], 'uuid');
            $payload['country_id']=$country->id;
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
