<?php

namespace App\Http\Requests;

use App\Models\Area;
use App\Models\City;
use App\Models\Locality;
use App\Rules\Latitude;
use App\Rules\MobileRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Profile request",
 *      description="Update Profile request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateProfileRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated profile",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        return [
            'name'                => 'nullable|string|max:255',
            'family'              => 'nullable|string|max:255',
            'mobile'              => ['nullable', 'numeric', 'max_digits:11', new MobileRule()],
            'city_id'             => ['nullable', 'numeric', Rule::exists((new City())->getTable(), 'id')],
            'area_id'             => ['nullable', 'numeric', Rule::exists((new Area())->getTable(), 'id')],
            'locality_id'         => ['nullable', 'numeric', Rule::exists((new Locality())->getTable(), 'id')],
            'address'             => 'nullable|string|max:255',
            'bio'                 => 'nullable|string|max:255',
            'latitude'            => ['nullable', new Latitude()],
            'longitude'           => ['nullable', new Latitude()],
            'enable_notification' => 'nullable|bool',
            'enable_subscription' => 'nullable|bool',
        ];
    }
}
