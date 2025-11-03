<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @OA\Schema(
 *     title="City",
 *     description="City model",
 *     @OA\Xml(
 *         name="City"
 *     )
 * )
 */
class City extends Model implements HasMedia
{
    use HasFactory,
        HasUUID,
        InteractsWithMedia,
        HasTranslationAuto;
    
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
        'uuid', 'province_id', 'published',
    ];
    
    public array $translatable = [
        'title',
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
    
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'city_id');
    }
    
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function estates(): HasMany
    {
        return $this->hasMany(Estate::class);
    }
}
