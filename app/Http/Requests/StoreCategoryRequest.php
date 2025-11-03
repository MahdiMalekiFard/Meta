<?php

namespace App\Http\Requests;

use App\Enums\CategoryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Category request",
 *      description="Store Category request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreCategoryRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new category",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;

    public function rules(): array
    {
        return [
            'locale'    => 'required|string',
            'parent_id' => 'required|exists:categories,id',
            'type'      => ['required', Rule::in(CategoryTypeEnum::values())],
            
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            
            'published'       => '',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];
    }
}
