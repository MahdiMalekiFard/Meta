<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Service request",
 *      description="Update Service request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateServiceRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated service",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        $rules = (new StoreServiceRequest())->rules();
        return array_merge($rules, [
        
        ]);
    }
}
