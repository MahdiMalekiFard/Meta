<?php

namespace App\Actions\City;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCityAction
{
    use AsAction;

    public function __construct(
        private readonly CityRepositoryInterface $repository,
       private readonly ProvinceRepositoryInterface $provinceRepository
    )
    {
    }


    /**
     * @param City                                          $city
     * @param array{name:string,mobile:string,email:string} $payload
     * @return City
     */
    public function handle(City $city, array $payload): City
    {
        return DB::transaction(function () use ($city, $payload) {
            $payload['province_id'] = $this->provinceRepository->find( $payload['province_uuid'],'uuid')->id;
            $city->update($payload);
            SyncTranslationAction::run($city);
            return $city;
        });
    }
}
