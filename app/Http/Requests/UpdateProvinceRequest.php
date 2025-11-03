<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Province request",
 *      description="Update Province request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateProvinceRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated province",
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
            'country_uuid'=>'required|uuid|exists:countries,uuid'
        ];
    }
}
