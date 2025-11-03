<?php

namespace App\Actions\Locality;

use App\Enums\PermissionEnum;
use App\Models\Locality;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateLocalityAction
{
    use AsAction;

    public function __construct(private readonly LocalityRepositoryInterface $repository)
    {
    }


    /**
     * @param Locality                                          $locality
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Locality
     */
    public function handle(Locality $locality, array $payload): Locality
    {
        return DB::transaction(function () use ($locality, $payload) {
            $locality->update($payload);
            return $locality;
        });
    }
}
