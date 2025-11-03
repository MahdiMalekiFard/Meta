<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserModule extends Pivot
{
    use HasUser;
    
    protected $fillable = ['user_id', 'module_id', 'limit'];
    protected $casts    = [
        'limit' => 'integer',
    ];
    
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
