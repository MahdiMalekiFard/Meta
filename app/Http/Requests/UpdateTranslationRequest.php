<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Translation request",
 *      description="Update Translation request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateTranslationRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated translation",
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
