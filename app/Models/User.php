<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\BooleanEnum;
use App\Traits\HasLike;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(name="User"),
 *     @OA\Property(property="id",title="ID",description="ID",format="int64",type="integer",example=1),
 *     @OA\Property(property="name",title="name",description="name",type="string",example="John"),
 *     @OA\Property(property="family",title="family",description="family",type="string",example="Doe"),
 *     @OA\Property(property="status",title="status",description="status",type="boolean",example=true),
 *     @OA\Property(property="mobile",title="mobile",description="mobile",type="string",example="09123456789"),
 *     @OA\Property(property="email",title="email",description="email",type="string",example="",format="email"),
 *     @OA\Property(property="google_id",title="google_id",description="google_id",type="string",example=""),
 * )
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, HasUUID, HasLike;
    use InteractsWithMedia;
    
    protected $fillable = [
        'name', 'family', 'status', 'mobile', 'password', 'email', 'google_id',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'password' => 'hashed',
        'status'   => BooleanEnum::class,
    ];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
             ->singleFile()
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('thumb')->fit(Fit::Crop, 100, 100);
                 $this->addMediaConversion('512')->fit(Fit::Crop, 512, 512);
             });
        $this->addMediaCollection('cart_melli_front')->singleFile();
        $this->addMediaCollection('cart_melli_back')->singleFile();
        $this->addMediaCollection('activity_permission')->singleFile();
    }
    
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
    
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->family;
    }
    
    public function rolesName(): string
    {
        $temp = array_column($this->roles->toArray(), 'name');
        return implode(',', $temp);
    }
    
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'user_services', 'user_id', 'service_id')
                    ->withPivot('started_at', 'expired_at', 'renew_at', 'type', 'created_at', 'updated_at');
    }
    
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'user_modules', 'user_id', 'module_id')
                    ->withPivot('started_at', 'expired_at', 'renew_at', 'created_at', 'updated_at');
    }
    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }
    
    public function server(): HasOne
    {
        return $this->hasOne(Server::class, 'user_id');
    }
    
}
