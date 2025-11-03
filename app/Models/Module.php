<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Module",
 *     description="Module model",
 *     @OA\Xml( name="Module"),
 *     @OA\Property(property="id", title="ID", description="ID", format="int64", type="integer", example=1),
 *     @OA\Property(property="uuid", title="uuid", description="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="key", title="key", description="key", type="string", example="key1"),
 *     @OA\Property(property="languages", title="languages", description="languages", type="array",@OA\Items(type="string"), example={"fa", "en"}),
 *     @OA\Property(property="is_public", title="is_public", description="is_public", type="boolean", example=true),
 * )
 */
class Module extends Model
{
    use HasFactory, HasUUID, HasTranslationAuto;
    
    protected    $fillable     = ['uuid', 'key', 'languages', 'is_public'];
    protected    $casts        = [
        'languages' => 'array',
        'is_public' => 'boolean',
        'key'       => ModuleEnum::class,
    ];
    public array $translatable = ['title', 'description'];
    
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->using(ServiceModule::class)->withPivot('order', 'limit', 'plan_id');
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(UserModule::class)->withPivot('started_at', 'expired_at', 'renew_at');
    }
    
}
