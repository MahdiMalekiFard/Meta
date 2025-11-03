<?php

namespace App\Http\Resources;

use App\Models\ReportReason;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ReportReasonResource",
 *     description="ReportReason resource",
 *     @OA\Xml(
 *         name="ReportReasonResource"
 *     )
 * )
 */
class ReportReasonResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var ReportReason[]
     */
    private array $data;


    public function toArray(Request $request): array
    {
        return [
                    'id'=>$this->id,
                ];
    }
}
