<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update User request",
 *      description="Update User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated user",
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
            'email'                 => 'required|email|unique:users,email,'.request()->user->id,
        ];
    }
}
