<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Plan request",
 *      description="Store Plan request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StorePlanRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new plan",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'service_id'               => 'required|exists:services,id',
            'description'              => 'required|string|max:255',
            'prices'                   => 'required|array',
            'prices.*'                 => 'required|array',
            'prices.*.*'               => 'required|array',
            'prices.*.*.price'         => 'required|numeric|gte:prices.*.*.price_special',
            'prices.*.*.price_special' => 'required|numeric',
        ];
    }
}
