<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store City request",
 *      description="Store City request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreCityRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new city",
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
