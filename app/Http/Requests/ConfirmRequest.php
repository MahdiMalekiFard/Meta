<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Confirm request",
 *      description="Confirm user request body data",
 *      type="object",
 *      required={"email", "code"},
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          description="user email",
 *          example="user@gmail.com"
 *      ),
 *      @OA\Property(
 *          property="code",
 *          type="string",
 *          description="received code",
 *          example="1234"
 *      ),
 * )
 */
class ConfirmRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'email' => 'required|email',
//            'email' => 'required|digits:11|regex:/09[0-9]{8}/',
            'code' => 'required|digits:4|exists:activation_codes,code',
        ];
    }
}
