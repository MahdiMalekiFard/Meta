<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasUUID
{
    protected static function bootHasUUID(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }

    /**
     * Scope a query to only include uuid.
     *
     * @param Builder $query
     * @param string  $uuid
     *
     * @return Builder
     */
    public function scopeOfUuid(Builder $query, string $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }
}
