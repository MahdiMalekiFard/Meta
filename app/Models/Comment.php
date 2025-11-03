<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasLike;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Comment",
 *     description="Comment model",
 *     @OA\Xml(
 *         name="Comment"
 *     )
 * )
 */
class Comment extends Model
{
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
    
    use HasFactory,
        HasUUID,
        HasUser,
        HasView,
        HasLike,
        HasTranslationAuto;
    
    protected    $fillable     = [
        'user_id',
        'uuid',
        'parent_id',
        'commentable_id',
        'commentable_type',
        'published',
        'comment',
    ];
    public array $translatable = [
        'title',
        'description',
    ];
    
    protected $casts = [
        'published' => BooleanEnum::class,
    ];
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
    
    public function child(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
    
    public function getParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }
    
    public function scopeActive(Builder $query,bool $value=true): Builder
    {
        return $query->where('published', $value);
    }
}
