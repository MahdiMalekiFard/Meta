<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Opinion request",
 *      description="Update Opinion request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateOpinionRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated opinion",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        $rules = (new StoreOpinionRequest())->rules();
        return array_merge($rules,[
        
        ]);
    }
}
