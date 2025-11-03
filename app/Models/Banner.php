<?php

namespace App\Models;

use App\Traits\HasSchemalessAttributes;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @OA\Schema(
 *     title="Banner",
 *     description="Banner model",
 *     @OA\Xml(
 *         name="Banner"
 *     )
 * )
 */
class Banner extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasTranslationAuto,
        HasSchemalessAttributes;
    
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
    protected   $fillable = [
        'link',
        'button',
        'gravity',
        'click',
        'limit',
        'published',
        'expire_at',
        'languages',
        'extra_attributes',
    ];
    
    protected $casts = [
        'languages'        => 'array',
        'extra_attributes' => 'array',
    ];
    
    public array $translatable = [
        'title',
        'description',
    ];
    
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('published', true);
    }
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('image')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('thumb')->width(200)->height(200);
                     $this->addMediaConversion('1080')->width(1920)->height(1080);
                 });
    }
}
