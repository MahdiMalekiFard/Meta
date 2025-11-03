<?php

namespace App\Http\Requests;

use App\Rules\Latitude;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Service request",
 *      description="Store Service request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreServiceRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new service",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'locale' => 'required|string',
            
            'key'                   => 'required|string|max:255|regex:/^[A-Z]+$/', // Only uppercase letters
            'title'                 => 'required|string|max:255',
            'description'           => 'required|string',
            'modules'               => 'required|array',
            'modules.*.key'         => 'required|string',
            //            'modules.*.sort'        => 'required|integer',
            'modules.*.plan_type_1' => 'nullable|integer',
            'modules.*.plan_type_2' => 'nullable|integer',
            'modules.*.plan_type_3' => 'nullable|integer',
            'modules.*.plan_type_4' => 'nullable|integer',
        ];
    }
}
