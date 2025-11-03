<?php

namespace App\Models;

use App\Enums\PlanTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;
use PowerComponents\LivewirePowerGrid\Tests\Concerns\Models\Order;

/**
 * @OA\Schema(
 *     title="OrderItem",
 *     description="OrderItem model",
 *     @OA\Xml( name="OrderItem"),
 *     @OA\Property(property="id",title="ID",description="ID",format="int64",type="integer",example=1),
 *     @OA\Property(property="order_id",title="order_id",description="order_id",format="int64",type="integer",example=1),
 *     @OA\Property(property="orderable_type",title="orderable_type",description="orderable_type",type="string",example="App\Models\Plan"),
 *     @OA\Property(property="orderable_id",title="orderable_id",description="orderable_id",format="int64",type="integer",example=1),
 *     @OA\Property(property="price",title="price",description="price",format="int64",type="integer",example=100000),
 *     @OA\Property(property="month",title="month",description="month",format="int64",type="integer",example=1),
 *     @OA\Property(property="type",title="type",description="some value from PlanTypeEnum",format="int64",type="integer",example=1),
 *     @OA\Property(property="extra_attributes",title="extra_attributes",description="extra_attributes",type="object"),
 *
 * )
 */
class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'orderable_type',
        'orderable_id',
        'price',
        'month',
        'type',
        'extra_attributes',
    ];
    
    protected $casts = [
        'extra_attributes' => 'array',
        'type'             => PlanTypeEnum::class,
    ];
    
    public function orderable(): BelongsTo
    {
        return $this->morphTo();
    }
    
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
}
