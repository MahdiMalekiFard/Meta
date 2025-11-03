<?php

namespace App\Models;

use App\Traits\HasSchemalessAttributes;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Setting",
 *     description="Setting model",
 *     @OA\Xml(
 *         name="Setting"
 *     )
 * )
 */
class Setting extends Model
{
    use HasFactory, HasUUID, HasSchemalessAttributes;
    
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
    
    public    $timestamps = false;
    
    protected $fillable = [
        'key',
        'value',
        'help',
        'roles',
        'extra_attributes',
    ];
    protected $casts    = [
        'roles'            => 'array',
        'extra_attributes' => 'array',
    ];
}
