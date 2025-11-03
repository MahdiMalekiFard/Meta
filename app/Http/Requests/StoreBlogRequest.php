<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Blog request",
 *      description="Store Blog request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreBlogRequest extends FormRequest
{
    use FillAttributes;
    
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new blog",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'locale'          => 'required|string',
            'categories_id'   => 'required|array',
            'categories_id.*' => 'exists:categories,id',
            
            'tags_id'   => 'array',
            'tags_id.*' => 'exists:tags,id',
            
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'body'        => 'required|string',
            
            'published'       => '',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];
    }
}
