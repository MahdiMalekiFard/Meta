<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Message request",
 *      description="Store Message request body data",
 *      type="object",
 *      required={"message"},
 *      @OA\Xml(name="StoreMessageRequest"),
 *      @OA\Property(property="message", type="string", example="This is a message"),
 *      @OA\Property(property="media", type="file", example="file"),
 * )
 */
class StoreMessageRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'message' => 'required',
            'media'   => 'nullable|file|max:4096',
        ];
    }
}
