<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Setting request",
 *      description="Store Setting request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreSettingRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new setting",
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
