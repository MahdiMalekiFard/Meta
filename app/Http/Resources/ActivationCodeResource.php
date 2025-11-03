<?php

namespace App\Http\Resources;

use App\Models\ActivationCode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ActivationCodeResource",
 *     description="ActivationCode resource",
 *     @OA\Xml(
 *         name="ActivationCodeResource"
 *     )
 * )
 */
class ActivationCodeResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var ActivationCode[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
