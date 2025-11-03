<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store ReportReason request",
 *      description="Store ReportReason request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreReportReasonRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new reportReason",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'required|string|max:1100',
            'published'=>''
        ];
    }
}
