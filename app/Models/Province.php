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

/**
 * @OA\Schema(
 *     title="Province",
 *     description="Province model",
 *     @OA\Xml(
 *         name="Province"
 *     )
 * )
 */
class Province extends Model
{
    use HasUUID,
        HasTranslationAuto,
        HasFactory;

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
        'uuid', 'country_id','published',
    ];
    
    public array $translatable = [
        'title',
    ];
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_id');
    }

}
