<?php

namespace App\Http\Resources;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ProvinceResource",
 *     description="Province resource",
 *     @OA\Xml(
 *         name="ProvinceResource"
 *     )
 * )
 */
class ProvinceResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Province[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
