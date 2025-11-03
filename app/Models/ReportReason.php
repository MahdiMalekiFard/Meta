<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="ReportReason",
 *     description="ReportReason model",
 *     @OA\Xml(
 *         name="ReportReason"
 *     )
 * )
 */
class ReportReason extends Model
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
    private int  $id;
    protected    $fillable     = [
        'published',
    ];
    public array $translatable = [
        'title',
        'description',
    ];
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
    
}
