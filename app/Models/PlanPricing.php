<?php

namespace App\Models;

use App\Enums\PlanTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="PlanPricing",
 *     description="PlanPricing model",
 *     @OA\Xml(
 *         name="PlanPricing"
 *     ),
 *
 *     @OA\Property(property="id",title="ID",description="ID",format="int64",type="integer",example=1),
 *     @OA\Property(property="plan_id",title="plan_id",description="plan_id",format="int64",type="integer",example=1),
 *     @OA\Property(property="price",title="price",description="price",format="int64",type="integer",example=100000),
 *     @OA\Property(property="price_special",title="price_special",description="price_special",format="int64",type="integer",example=80000),
 *     @OA\Property(property="month",title="month",description="month",format="int64",type="integer",example=1),
 *     @OA\Property(property="type",title="type",description="some value from PlanTypeEnum",format="int64",type="integer",example=1),
 *
 * )
 */
class PlanPricing extends Model
{
    use HasFactory;
    
    protected $fillable = ['plan_id', 'month', 'price', 'price_special', 'type'];
    
    protected $casts = [
        'month'    => 'integer',
        'price'    => 'integer',
        'price_special' => 'integer',
        'type'     => PlanTypeEnum::class,
    ];
    
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
