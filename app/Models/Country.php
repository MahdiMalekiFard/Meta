<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Country",
 *     description="Country model",
 *     @OA\Xml(
 *         name="Country"
 *     )
 * )
 */
class Country extends Model
{
    use HasFactory,
        HasTranslationAuto,
        HasUUID;
    
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
        'uuid',
        'code',
        'published',
    ];
    
    public array $translatable = [
        'title',
    ];
    
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
}
