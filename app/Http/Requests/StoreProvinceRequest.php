<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Province request",
 *      description="Store Province request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreProvinceRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new province",
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
