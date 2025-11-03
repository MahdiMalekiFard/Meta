<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @OA\Schema(
 *     title="Message",
 *     description="Message model",
 *     @OA\Xml(name="Message"),
 *     @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 *     @OA\Property(property="uuid", type="string", readOnly="true", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="ticket_id", type="integer", example="1"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="message", type="string", example="This is a message"),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly="true"),
 * )
 */
class Message extends Model implements HasMedia
{
    use HasFactory;
    use HasUUID,InteractsWithMedia;
    
    protected $fillable= [
        'ticket_id',
        'user_id',
        'message',
        'uuid',
        'read_by',
        'read_at',
    ];
    
    protected $casts = [
        'read_at' => 'datetime',
    ];
    
    protected $appends = ['is_me'];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media')->singleFile();
    }
    
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function readBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'read_by');
    }
    
    public function getIsMeAttribute(): bool
    {
        return auth('sanctum')->id() === $this->user_id;
    }
    
}
