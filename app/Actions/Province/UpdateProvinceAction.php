<?php

namespace App\Actions\Province;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Province;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProvinceAction
{
    use AsAction;

    public function __construct(
        private readonly ProvinceRepositoryInterface $repository,
        private readonly CountryRepositoryInterface $countryRepository
    )
    {
    }


    /**
     * @param Province                                          $province
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Province
     */
    public function handle(Province $province, array $payload): Province
    {
        return DB::transaction(function () use ($province, $payload) {
            $payload['country_id'] = $this->countryRepository->find( $payload['country_uuid'],'uuid')->id;
            $province->update($payload);
            SyncTranslationAction::run($province);
            return $province;
        });
    }
}
