<?php

namespace App\Http\Resources;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OpinionResource",
 *     description="Opinion resource",
 *     @OA\Xml(
 *         name="OpinionResource"
 *     )
 * )
 */
class OpinionResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Opinion[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
