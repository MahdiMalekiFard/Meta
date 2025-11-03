<?php

namespace App\Models;

use App\Enums\OpinionPartEnum;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @OA\Schema(
 *     title="Opinion",
 *     description="Opinion model",
 *     @OA\Xml(
 *         name="Opinion"
 *     )
 * )
 */
class Opinion extends Model implements HasMedia
{
    use HasFactory, HasUser, InteractsWithMedia,HasTranslationAuto,HasSlugFromTranslationTitle;
    
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
    
    protected $fillable = ['slug', 'user_id', 'published', 'part','star'];
    
    protected    $casts       = [
        'part' => OpinionPartEnum::class,
    ];
    public array $translatable = ['title', 'body', 'company'];
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('image')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('thumb')->width(200)->height(200);
                     $this->addMediaConversion('480')->width(480)->height(480);
                 });
    }
}
