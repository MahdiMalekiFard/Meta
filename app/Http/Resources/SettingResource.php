<?php

namespace App\Http\Resources;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SettingResource",
 *     description="Setting resource",
 *     @OA\Xml(
 *         name="SettingResource"
 *     )
 * )
 */
class SettingResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Setting[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
