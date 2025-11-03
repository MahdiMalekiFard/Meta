<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Server request",
 *      description="Update Server request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateServerRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated server",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        $rules = (new StoreServerRequest())->rules();
        return array_merge($rules, [

        ]);
    }
}
