<?php

namespace App\Http\Resources;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="NoticeResource",
 *     description="Notice resource",
 *     @OA\Xml(
 *         name="NoticeResource"
 *     )
 * )
 */
class NoticeResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Notice[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
