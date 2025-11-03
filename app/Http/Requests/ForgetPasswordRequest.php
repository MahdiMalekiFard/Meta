<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Forget Password Request",
 *      description="Login request body data",
 *      type="object",
 *      required={"email"},
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          description="user email",
 *          example="admin@gmail.com"
 *      ),
 * )
 */
class ForgetPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }
}
