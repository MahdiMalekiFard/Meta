<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Locality",
 *     description="Locality model",
 *     @OA\Xml(
 *         name="Locality"
 *     )
 * )
 */
class Locality extends Model
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
    
    protected $fillable = ['area_id'];
    
    public array $translatable = [
        'title',
    ];
    
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
