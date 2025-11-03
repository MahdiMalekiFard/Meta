<?php

namespace App\Actions\City;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCityAction
{
    use AsAction;
    
    public function __construct(
        private readonly CityRepositoryInterface $repository,
        private readonly ProvinceRepositoryInterface $provinceRepository)
    {
    }
    
    public function handle(array $payload): City
    {
        return DB::transaction(function () use ($payload) {
            $payload['province_id'] = $this->provinceRepository->find($payload['province_uuid'],'uuid')->id;
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
