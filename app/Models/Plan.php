<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Plan",
 *     description="Plan model",
 *     @OA\Xml(
 *         name="Plan"
 *     ),
 *
 *     @OA\Property(property="planable_id", title="planable id", type="integer", description="reference to planable", example="1"),
 *     @OA\Property(property="planable_type", title="planable type", type="string", description="reference to planable", example="App\Models\Service"),
 *     @OA\Property(property="limit", title="limit", type="integer", description="limit", example="1"),
 *
 * )
 */
class Plan extends Model
{
    use HasFactory, HasUUID,HasTranslationAuto;
    
    public array $translatable = ['title','description'];
    
    protected   $fillable = ['uuid', 'languages', 'planable_id', 'planable_type', 'limit']; //morph to service|module
    
    protected   $casts    = [
        'languages' => 'array',
        'limit' => 'integer',
    ];
    
    public function planable():MorphTo
    {
        return $this->morphTo();
    }
    
    public function pricings(): HasMany
    {
        return $this->hasMany(PlanPricing::class, 'plan_id');
    }
    
}
