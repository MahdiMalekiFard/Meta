<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Area",
 *     description="Area model",
 *     @OA\Xml(
 *         name="Area"
 *     )
 * )
 */
class Area extends Model
{
    use HasFactory,
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
    
    protected $fillable = ['city_id'];
    
    public array $translatable = [
        'title',
    ];
    
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class);
    }
}
