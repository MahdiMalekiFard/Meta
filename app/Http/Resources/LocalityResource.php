<?php

namespace App\Http\Resources;

use App\Models\Locality;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="LocalityResource",
 *     description="Locality resource",
 *     @OA\Xml(
 *         name="LocalityResource"
 *     )
 * )
 */
class LocalityResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Locality[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
