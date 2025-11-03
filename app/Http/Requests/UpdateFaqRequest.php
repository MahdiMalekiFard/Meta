<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Faq request",
 *      description="Update Faq request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateFaqRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated faq",
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
            'part'=>'required|string',
            'published'=>'boolean',
        ];
    }
}
