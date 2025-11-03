<?php

namespace App\Models;

use App\Enums\OpinionPartEnum;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Faq",
 *     description="Faq model",
 *     @OA\Xml(
 *         name="Faq"
 *     )
 * )
 */
class Faq extends Model
{
    use HasFactory, HasTranslationAuto;
    
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
    
    protected   $fillable = ['part', 'published'];
    
    protected $casts = [
        'part' => OpinionPartEnum::class,
    ];
    
    public array $translatable = ['title', 'description'];
    
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('published', true);
    }
    
}
