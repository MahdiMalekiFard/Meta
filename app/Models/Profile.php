<?php

namespace App\Models;

use App\Traits\HasSchemalessAttributes;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Profile",
 *     description="Profile model",
 *     @OA\Xml(name="Profile"),
 *     @OA\Property(property="id",title="ID",description="ID",format="int64",type="integer",example=1),
 *     @OA\Property(property="user_id",title="user_id",description="user_id",format="int64",type="integer",example=1),
 *     @OA\Property(property="address",title="address",description="address",type="string",example="This is an address"),
 *     @OA\Property(property="bio",title="bio",description="bio",type="string",example="This is a bio"),
 *     @OA\Property(property="latitude",title="latitude",description="latitude",type="string",example="123.456"),
 *     @OA\Property(property="longitude",title="longitude",description="longitude",type="string",example="123.456"),
 *     @OA\Property(property="mobile_verify_at",title="mobile_verify_at",description="mobile_verify_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="email_verify_at",title="email_verify_at",description="email_verify_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="fcm_token",title="fcm_token",description="fcm_token",type="string",example="fcm_token"),
 *     @OA\Property(property="last_login_at",title="last_login_at",description="last_login_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="google_id",title="google_id",description="google_id",type="string",example="google_id"),
 *     @OA\Property(property="enable_notification",title="enable_notification",description="enable_notification",type="boolean",example=true),
 *     @OA\Property(property="enable_subscription",title="enable_subscription",description="enable_subscription",type="boolean",example=true),
 *     @OA\Property(property="test_period_usage",title="test_period_usage",description="test_period_usage",type="boolean",example=true),
 *     @OA\Property(property="extra_attributes",title="extra_attributes",description="extra_attributes",type="object"),
 *     @OA\Property(property="created_at",title="created_at",description="created_at",type="string",example="2022-04-06 08:14:40"),
 *     @OA\Property(property="updated_at",title="updated_at",description="updated_at",type="string",example="2022-04-06 08:14:40"),
 * )
 */
class Profile extends Model
{
    protected $table = 'profiles';
    use HasFactory, HasUser,HasSchemalessAttributes;
    
    protected $fillable = [
        'user_id',
        'address',
        'bio',
        'latitude',
        'longitude',
        'mobile_verify_at',
        'email_verify_at',
        'fcm_token',
        'last_login_at',
        'google_id',
        'enable_notification',
        'enable_subscription',
        'test_period_usage',
        'extra_attributes',
    ];
    
    protected $casts = [
        'extra_attributes'    => 'array',
        'mobile_verify_at'    => 'datetime',
        'email_verify_at'     => 'datetime',
        'last_login_at'       => 'datetime',
        'enable_notification' => 'boolean',
        'enable_subscription' => 'boolean',
        'test_period_usage'   => 'boolean',
    ];
    
}
