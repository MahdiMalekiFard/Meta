<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Order",
 *     description="Order model",
 *     @OA\Xml(name="Order"),
 *     @OA\Property(property="id",title="ID",description="ID",format="int64",type="integer",example=1),
 *     @OA\Property(property="user_id",title="user_id",description="user_id",format="int64",type="integer",example=1),
 *     @OA\Property(property="total_price",title="total_price",description="total_price",format="int64",type="integer",example=100000),
 *     @OA\Property(property="note",title="note",description="note",type="string",example="This is a note"),
 *     @OA\Property(property="status",title="status",description="some value from OrderStatusEnum",type="string",example="pending"),
 *     @OA\Property(property="expired_at",title="expired_at",description="expired_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="canceled_by",title="canceled_by",description="canceled_by",format="int64",type="integer",example=1),
 *     @OA\Property(property="canceled_at",title="canceled_at",description="canceled_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="paid_at",title="paid_at",description="paid_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="paid_by",title="paid_by",description="paid_by",format="int64",type="integer",example=1),
 *     @OA\Property(property="payment_method",title="payment_method",description="payment_method",type="string",example="Bank Transfer"),
 *     @OA\Property(property="order_number",title="order_number",description="order_number",type="string",example="ORD0000000001"),
 *     @OA\Property(property="repeatable",title="repeatable",description="repeatable",type="boolean",example=false),
 *     @OA\Property(property="extra_attributes",title="extra_attributes",description="extra_attributes",type="object"),
 * )
 */
class Order extends Model
{
    use HasFactory, HasUUID, HasSchemalessAttributes, HasUser;
    
    protected $fillable = [
        'user_id',
        'total_price',
        'discount_price',
        'note',
        'status',
        'expired_at',
        'canceled_by',
        'canceled_at',
        'paid_at',
        'paid_by',
        'payment_method',
        'extra_attributes',
        'repeatable',
    ];
    
    protected $casts = [
        'extra_attributes' => 'array',
        'expired_at'       => 'datetime',
        'canceled_at'      => 'datetime',
        'paid_at'          => 'datetime',
        'status'           => OrderStatusEnum::class,
    ];
    
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    
    public function orderNumber(): string
    {
        return 'ORD' . str_pad($this->id, 10, '0', STR_PAD_LEFT);
    }
    
    public function cancel(): void
    {
        $this->update([
            'status'      => OrderStatusEnum::CANCEL,
            'canceled_at' => now(),
            'canceled_by' => auth()->id(),
        ]);
    }
    
    public function paid(): void
    {
        $this->update([
            'status'  => OrderStatusEnum::PAID,
            'paid_at' => now(),
            'paid_by' => auth()->id(),
        ]);
    }
    
}
