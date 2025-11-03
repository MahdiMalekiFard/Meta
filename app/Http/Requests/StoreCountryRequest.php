<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Country request",
 *      description="Store Country request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreCountryRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new country",
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
            'code'=>'nullable|string',
            'published'=>''
        ];
    }
}
