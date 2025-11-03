<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Enums\CategoryTypeEnum;
use App\Traits\HasCategories;
use App\Traits\HasCity;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTag;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

/**
 * @OA\Schema(
 *     title="Service",
 *     description="Service model",
 *     @OA\Xml(name="Service"),
 *     @OA\Property(property="id", title="id", description="id", format="int64", type="integer", example=1),
 *     @OA\Property(property="uuid", title="uuid", description="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="key", title="key", description="key", type="string", example="service"),
 *     @OA\Property(property="languages", title="languages", description="languages", type="array", @OA\Items(type="string"), example={"fa", "en"}),
 *     @OA\Property(property="extra_attributes", title="extra_attributes", description="extra_attributes", type="array", @OA\Items(type="string"), example={"fa", "en"}),
 * )
 */
class Service extends Model implements HasMedia
{
    use HasTranslationAuto,
        HasFactory,
        InteractsWithMedia,
        HasUUID;
    
    public array $translatable = ['title', 'description'];
    
    protected $fillable = ['uuid', 'key', 'languages', 'extra_attributes'];
    protected $casts    = [
        'languages'        => 'array',
        'extra_attributes' => 'array',
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('image')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('thumb')->width(200)->height(200);
                     $this->addMediaConversion('480')->width(854)->height(480);
                     $this->addMediaConversion('720')->width(1280)->height(720);
                 });
    }
    
    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }
    
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'service_modules', 'service_id', 'module_id')
                    ->withPivot('plan_type', 'order', 'limit')
                    ->withTimestamps();
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_services', 'service_id', 'user_id')
                    ->withPivot('started_at', 'expired_at', 'renew_at')
                    ->withTimestamps();
    }
}
