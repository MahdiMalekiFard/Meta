<?php

namespace App\Http\Resources;

use App\Models\PlanPricing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="PlanPricingResource",
 *     description="PlanPricing resource",
 *     @OA\Xml(
 *         name="PlanPricingResource"
 *     )
 * )
 */
class PlanPricingResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var PlanPricing[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
