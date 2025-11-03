<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Like",
 *     description="Like model",
 *     @OA\Xml(
 *         name="Like"
 *     )
 * )
 */
class Like extends Model
{
    use HasFactory;
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
    
    use HasFactory, HasUser;
    
    protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type',
    ];
    
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
