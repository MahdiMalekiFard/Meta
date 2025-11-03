<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Translation",
 *     description="Translation model",
 *     @OA\Xml(
 *         name="Translation"
 *     )
 * )
 */
class Translation extends Model
{
    use HasFactory;
    
    public $timestamps = null;
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
    
    protected $fillable = ['translatable_id', 'translatable_type', 'key', 'value', 'locale'];
    
    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
