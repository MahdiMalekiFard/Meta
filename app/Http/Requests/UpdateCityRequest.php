<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update City request",
 *      description="Update City request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateCityRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated city",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'province_uuid'=>'required|uuid|exists:provinces,uuid'
        ];
    }
}
