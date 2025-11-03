<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="MessageResource",
 *     description="Message resource",
 *     @OA\Xml(name="MessageResource"),
 *     @OA\Property(property="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="message", type="string", example="This is a message"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="media", type="array", nullable=true, @OA\Items(ref="#/components/schemas/MediaResource")),
 * )
 */
class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid'       => $this->uuid,
            'user_id'    => $this->user_id,
            'message'    => $this->message,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_me' => $this->is_me,
            'user'       => $this->whenLoaded('user', function () {
                return UserResource::make($this->resource->user);
            }),
            'media'      => $this->whenLoaded('media', function () {
                return MediaResource::collection($this->resource->getMedia('*'));
            }),
        ];
    }
}
