<?php

namespace App\Traits;


use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCity{
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
