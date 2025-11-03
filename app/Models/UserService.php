<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserService extends Pivot
{
    use HasUser;
    
    protected $fillable = ['user_id', 'service_id', 'started_at', 'expired_at', 'renew_at','type'];
    protected $casts    = [
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'renew_at'   => 'datetime',
    ];
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    
    public function isActive(): bool
    {
        return now()->between($this->started_at, $this->expired_at);
    }
}
