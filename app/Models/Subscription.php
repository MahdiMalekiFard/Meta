<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Subscription",
 *     description="Subscription model",
 *     @OA\Xml(
 *         name="Subscription"
 *     )
 * )
 */
class Subscription extends Model
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
    
    protected $fillable = [
        'email',
    ];
    
}
