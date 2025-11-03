<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ActivationCode",
 *     description="ActivationCode model",
 *     @OA\Xml(
 *         name="ActivationCode"
 *     )
 * )
 */
class ActivationCode extends Model
{
    use HasFactory, HasUUID, HasUser;
    
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private int $id;
    
    protected $fillable = ['user_id', 'code', 'used', 'expire_at'];
    
    public function scopeActive(Builder $query, bool $value = false): Builder
    {
        return $query->where('used', $value)->where('expire_at', '>', Carbon::now());
    }
    
    public function scopeCreateCode($query, $user): ActivationCode
    {
        $code = $this->code();
        
        return $query->create([
            'user_id' => $user->id,
            'code'    => $code,
            'expire'  => Carbon::now()->addMinutes(15),
        ]);
    }
    
    private function code(): string
    {
        do {
            $code = Str::random(60);
            $check_code = static::whereCode($code)->get();
        } while (!$check_code->isEmpty());
        
        return $code;
    }
    
}
