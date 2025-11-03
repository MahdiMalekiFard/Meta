<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Opinion request",
 *      description="Store Opinion request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreOpinionRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new opinion",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'company'   => 'string|max:255',
            'body'      => 'required|string',
            'published' => 'bool',
            'star'      => 'numeric|min:1|max:5',
        ];
    }
}
