<?php

namespace App\Actions\Profile;

use App\Enums\PermissionEnum;
use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProfileAction
{
    use AsAction;
    
    public function __construct(
        private readonly ProfileRepositoryInterface $repository,
        private readonly FileService $fileService)
    {
    }
    
    /**
     * @param Profile                                       $profile
     * @param array{name:string,mobile:string,email:string} $payload
     *
     * @return Profile
     */
    public function handle(Profile $profile, array $payload): Profile
    {
        return DB::transaction(function () use ($profile, $payload) {
            
            $profile->update($payload);
            
            $profile->user()->update([
                'name'        => Arr::get($payload, 'name'),
                'family'      => Arr::get($payload, 'family'),
                'mobile'      => Arr::get($payload, 'mobile'),
                'city_id'     => Arr::get($payload, 'city_id'),
                'area_id'     => Arr::get($payload, 'area_id'),
                'locality_id' => Arr::get($payload, 'locality_id'),
            ]);
            $this->fileService->addMedia($profile->user,'avatar','avatar');
            return $profile->fresh();
        });
    }
}
