<?php

namespace App\Actions\Area;

use App\Enums\PermissionEnum;
use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAreaAction
{
    use AsAction;

    public function __construct(private readonly AreaRepositoryInterface $repository)
    {
    }


    /**
     * @param Area                                          $area
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Area
     */
    public function handle(Area $area, array $payload): Area
    {
        return DB::transaction(function () use ($area, $payload) {
            $area->update($payload);
            return $area;
        });
    }
}
