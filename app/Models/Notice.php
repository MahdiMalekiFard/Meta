<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasSlug;

/**
 * @OA\Schema(
 *     title="Notice",
 *     description="Notice model",
 *     @OA\Xml(
 *         name="Notice"
 *     )
 * )
 */
class Notice extends Model
{
    use HasFactory,
        SoftDeletes,
        HasUser,
        InteractsWithMedia,
        HasSchemalessAttributes,
        HasLike,
        HasView,
        HasUUID,
        HasSlug,
        HasComment,
        HasTranslationAuto,
        HasCategory;

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
    
    protected $fillable = [
'category_id',
'user_id',
'published',
'extra_attributes',
'total_click',
'total_view',
'total_comment',
'total_like',
'languages'
    ];
    protected $casts = [
        'extra_attributes' => 'array',
    ];
    
    // extra_attributes : ExtraEnum::class
    
    protected array $translatable = [
        'title', 'description','slug'
    ];
    
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('notice')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('1200-760')->width(1200)->height(760);
                     $this->addMediaConversion('200-200')->width(200)->height(200);
                 });
    }
}
