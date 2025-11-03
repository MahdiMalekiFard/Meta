<?php

namespace App\Models;

use App\Enums\CategoryTypeEnum;
use App\Traits\HasCategories;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category model",
 *     @OA\Xml(
 *         name="Category"
 *     )
 * )
 */
class Category extends Model implements HasMedia
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private int $id;
    
    use HasTranslationAuto,
        HasFactory,
        HasCategories,
        InteractsWithMedia,
        HasUUID, HasSlugFromTranslationTitle;
    
    public array $translatable = ['title', 'body'];
    
    protected $fillable = ['published', 'parent_id', 'slug', 'type', 'seo_title', 'seo_description', 'seo_keywords'];
    
    protected $casts = [
        'type' => CategoryTypeEnum::class,
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('image')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('thumb')->width(200)->height(200);
                     $this->addMediaConversion('480')->width(854)->height(480);
                 });
    }
    
    public function scopeWithRelations(Builder $query, ...$relations): Builder
    {
        return $query->with($relations);
    }
    
    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }
    
    public function categoryable(): MorphTo
    {
        return $this->morphTo();
    }
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }
    
    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
    
    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'categoryable');
    }
    
    public function services(): MorphToMany
    {
        return $this->morphedByMany(Service::class, 'categoryable');
    }
    
    public function estates(): MorphToMany
    {
        return $this->morphedByMany(Estate::class, 'categoryable');
    }
}
