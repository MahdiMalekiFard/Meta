<?php

namespace App\Http\Resources;

use App\Enums\PlanTypeEnum;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ServiceResource",
 *     description="Service resource",
 *     @OA\Xml(name="ServiceResource"),
 *     @OA\Property(property="uuid", title="uuid", description="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="key", title="key", description="key", type="string", example="service"),
 *     @OA\Property(property="title", title="title", description="title", type="string", example="Service title"),
 *     @OA\Property(property="description", title="description", description="description", type="string", example="Service description"),
 *     @OA\Property(property="image", title="image", description="image", type="string", example="https://example.com/image.jpg"),
 *
 * )
 */
class ServiceResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        $type = PlanTypeEnum::from($this->pivot->type);
        return [
            'uuid'        => $this->uuid,
            'key'         => $this->key,
            'title'       => $this->title,
            'description' => $this->description,
            'started_at'  => $this->pivot->started_at,
            'renew_at'  => $this->pivot->renew_at,
            'expired_at'  => $this->pivot->expired_at,
            'type'        => [
                'title' => $type->title(),
                'icon'  => $type->icon(),
            ],
            'media'       => $this->whenLoaded('media', function () {
                return MediaResource::collection($this->resource->getMedia('image'));
            }),
        ];
    }
}
