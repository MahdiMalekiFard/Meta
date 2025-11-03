<?php

namespace App\Models;

use App\Enums\PlanTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceModule extends Pivot
{
    
    protected $table    = 'service_modules';
    protected $fillable = ['service_id', 'module_id', 'plan_type', 'limit', 'order'];
    
    protected $casts = [
        'limit'     => 'integer',
        'order'     => 'integer',
        'plan_type' => PlanTypeEnum::class,
    ];
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
    
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
