<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User resource",
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          example="sajad"
 *      ),
 *      @OA\Property(
 *          property="family",
 *          type="string",
 *          example="eskandarian"
 *      ),
 * )
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'family' => $this->family,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'test_period_usage' => $this->profile?->test_period_usage,
        ];
    }
}
