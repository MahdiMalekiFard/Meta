<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update ActivationCode request",
 *      description="Update ActivationCode request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateActivationCodeRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated activationCode",
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
