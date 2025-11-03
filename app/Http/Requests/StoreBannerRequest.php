<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Banner request",
 *      description="Store Banner request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreBannerRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new banner",
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
            'link'=>'nullable|string',
            'gravity'=>'nullable|string',
            'button'=>'nullable|string',
            'click'=>'nullable|integer',
            'limit'=>'nullable|integer',
            'published'=>'nullable',
            'expire_at'=>'nullable',
            'extra_attributes'=>'array',
        ];
    }
}
