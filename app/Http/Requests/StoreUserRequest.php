<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreUserRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new user",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:255',
            'mobile'                => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|min:8',
        ];
    }
}
