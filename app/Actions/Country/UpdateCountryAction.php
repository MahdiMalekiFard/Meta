<?php

namespace App\Actions\Country;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCountryAction
{
    use AsAction;

    public function __construct(private readonly CountryRepositoryInterface $repository)
    {
    }


    /**
     * @param Country                                          $country
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Country
     */
    public function handle(Country $country, array $payload): Country
    {
        return DB::transaction(function () use ($country, $payload) {
            $country->update($payload);
            SyncTranslationAction::run($country);
            return $country;
        });
    }
}
