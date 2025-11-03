<?php

namespace App\Http\Requests;

use App\Enums\CategoryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Category request",
 *      description="Update Category request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateCategoryRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated category",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        $rules = (new StoreCategoryRequest())->rules();
        return array_merge($rules, []);
    }
}
