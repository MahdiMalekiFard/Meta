<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Register request",
 *      description="Store user request body data",
 *      type="object",
 *      required={"name", "family", "email", "password"},
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          example="sajad"
 *      ),
 *      @OA\Property(
 *          property="family",
 *          type="string",
 *          example="eskandarian"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          format="email",
 *          example="user2@gmail.com"
 *      ),
 *       @OA\Property(
 *           property="password",
 *           type="string",
 *           format="password",
 *           example="password123"
 *       ),
 *      @OA\Property(
 *           property="password_confirmation",
 *           type="string",
 *           format="password",
 *           example="password123"
 *       ),
 *       @OA\Property(
 *           property="terms",
 *           type="boolean",
 *           description="user confirm terms and policy",
 *           example="true"
 *       ),
 * )
 */
class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'family'   => 'required|string|max:255',
            'email'    => 'required|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms'     => 'required',
        ];
    }
}
