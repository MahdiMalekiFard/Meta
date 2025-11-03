<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Server request",
 *      description="Store Server request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreServerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ''=>'',
        ];
    }
}
