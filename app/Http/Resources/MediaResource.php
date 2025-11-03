<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="MediaResource",
 *     description="Media resource",
 *     @OA\Xml(name="MediaResource"),
 *     @OA\Property(property="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="name", type="string", example="This is a media name"),
 *     @OA\Property(property="mime_type", type="string", example="image/jpeg"),
 *     @OA\Property(property="size", type="integer", example="1024"),
 *     @OA\Property(property="order_column", type="integer", example="1"),
 *     @OA\Property(property="original_url", type="string", example="http://example.com/image.jpg"),
 * )
 */
class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'uuid'=> $this->uuid,
            'name'=> $this->name,
            'mime_type'=> $this->mime_type,
            'size'=> $this->size,
            'order_column'=> $this->order_column,
            'original_url'=> $this->original_url,
        ];
    }
}
