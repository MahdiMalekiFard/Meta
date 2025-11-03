<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="start test period request",
 *      description="start test period request",
 *      type="object",
 *      required={"name"},
 *     @OA\Property(property="domain_name", type="string", description="domain name", example="metanext"),
 * )
 */
class StoreTestPeriodOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain_name' => 'required|string|max:255|unique:servers,domain_name',
        ];
    }
}
