<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Login Request",
 *      description="Login request body data",
 *      type="object",
 *      required={"password", "password_confirmation"},
 *      @OA\Property(
 *          property="password",
 *          type="string",
 *          description="new password",
 *          example="password"
 *      ),
 *      @OA\Property(
 *          property="password_confirmation",
 *          type="string",
 *          description="password confirmation",
 *          example="password"
 *      ),
 * )
 */
class SetPasswordRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',//password must contain at least one uppercase letter, one lowercase letter, and one number
            ],
        ];
    }
}
