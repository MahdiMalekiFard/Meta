<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Setting request",
 *      description="Update Setting request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateSettingRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated setting",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'value'                    => 'sometimes|string',
            'extra_attributes'         => 'sometimes|array',
            'extra_attributes.*.name'   => 'required|string',
            'extra_attributes.*.value' => 'required|string',
        ];
    }
}
