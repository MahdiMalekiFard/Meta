<?php

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OrderItemResource",
 *     description="OrderItem resource",
 *     @OA\Xml(
 *         name="OrderItemResource"
 *     )
 * )
 */
class OrderItemResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var OrderItem[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
