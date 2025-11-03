<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Plan request",
 *      description="Update Plan request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdatePlanRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated plan",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        $rules = (new StorePlanRequest())->rules();
        return array_merge($rules, []);
    }
}
