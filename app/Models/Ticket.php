<?php

namespace App\Models;

use App\Enums\TicketActionTypeEnum;
use App\Enums\TicketDepartmentEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Ticket",
 *     description="Ticket model",
 *     @OA\Xml(name="Ticket"),
 *     @OA\Property(property="subject", type="string", example="This is a ticket subject"),
 *     @OA\Property(property="description", type="string", example="This is a ticket description"),
 *     @OA\Property(property="department", type="string", example="contact"),
 *     @OA\Property(property="closed_by", type="string", example="1"),
 *     @OA\Property(property="status", type="string", example="open"),
 *     @OA\Property(property="priority", type="string", example="low"),
 *     @OA\Property(property="ticket_number", type="string", example="TICKET-202109-1"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="messages", type="array", nullable=true, @OA\Items(ref="#/components/schemas/Message")),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *
 *
 * )
 */
class Ticket extends Model
{
    use HasFactory,
        HasUUID,
        HasUser;
    
    protected $appends = [
        'ticket_number',
    ];
    
    protected $fillable = [
        'subject',
        'description',
        'department',
        'user_id',
        'closed_by',
        'status',
        'priority',
        'action_type',
    ];
    protected $casts    = [
        'status'     => TicketStatusEnum::class,
        'department' => TicketDepartmentEnum::class,
        'priority'   => TicketPriorityEnum::class,
        'action_type' => TicketActionTypeEnum::class,
    ];
    
    public static function boot(): void
    {
        parent::boot();
        static::creating(function (Ticket $ticket) {
        });
    }
    
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    
    public function lastMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latest();
    }
    
    public function closedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by', 'id');
    }
    
    public function getTicketNumberAttribute(): string
    {
        return 'T-' . now()->format('ym') . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }
    
}
