<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Login Request",
 *      description="Login request body data",
 *      type="object",
 *      required={"email", "password"},
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          description="user email",
 *          example="admin@gmail.com"
 *      ),
 *      @OA\Property(
 *          property="password",
 *          type="string",
 *          example="password"
 *      ),
 * )
 */
class LoginRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }
}
