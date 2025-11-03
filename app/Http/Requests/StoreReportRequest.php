<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Report request",
 *      description="Store Report request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreReportRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new report",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        return [
            'user_id'=>'',
            'report_reason_id'=>'',
            'reportable_id'=>'',
            'reportable_type'=>'',
            'message'=>'',
        ];
    }
}
