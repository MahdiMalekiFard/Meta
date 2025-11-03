<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Like request",
 *      description="Store Like request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreLikeRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new like",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        return [
            ''=>'',
        ];
    }
}
