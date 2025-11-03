<?php

namespace App\Models;

use App\Traits\HasCategories;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

/**
 * @OA\Schema(
 *     title="Blog",
 *     description="Blog model",
 *     @OA\Xml(
 *         name="Blog"
 *     )
 * )
 */
class Blog extends Model implements HasMedia
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
    
    use HasFactory,
        SoftDeletes,
        HasUser,
        InteractsWithMedia,
        HasSchemalessAttributes,
        HasLike,
        HasView,
        HasUUID,
        HasSlugFromTranslationTitle,
        HasComment,
        HasTranslationAuto,
        HasTags,
        HasCategories;
    
    protected $fillable = [
        'uuid', 'slug', 'user_id', 'published', 'total_view', 'total_comment', 'total_like', 'languages',
        'extra_attributes', 'seo_title', 'seo_description', 'seo_keywords',
    ];
    
    public array $translatable = [
        'title',
        'description',
        'body',
    ];
    
    protected $casts = [
        'extra_attributes' => 'array',
        'total_comment'    => 'integer',
        'total_view'       => 'integer',
        'total_like'       => 'integer',
        'languages'        => 'array',
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
    
    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => route('blog.show', ['locale'=>app()->getLocale(),'blog'=>$attributes['slug']])
        );
    }
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
    
}
