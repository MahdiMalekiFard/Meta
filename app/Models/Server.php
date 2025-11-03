<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;
use PowerComponents\LivewirePowerGrid\Tests\Concerns\Models\Order;

/**
 * @OA\Schema(
 *     title="Server",
 *     description="Server model",
 *     @OA\Xml(name="Server"),
 *     @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 *     @OA\Property(property="uuid", type="string", readOnly="true", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="order_id", type="integer", example="1"),
 *     @OA\Property(property="website_url", type="string", example="https://example.com"),
 *     @OA\Property(property="domain_name", type="string", example="example"),
 *     @OA\Property(property="ip_address", type="string", example="192.168.1.1"),
 *     @OA\Property(property="has_ssl", type="boolean", example="true"),
 *     @OA\Property(property="has_backup", type="boolean", example="true"),
 *     @OA\Property(property="backup_frequency", type="string", example="daily"),
 *     @OA\Property(property="has_application", type="boolean", example="true"),
 *     @OA\Property(property="has_website", type="boolean", example="true"),
 *     @OA\Property(property="source_code_updated_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="application_updated_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="database_password", type="string", example="password"),
 *     @OA\Property(property="ssh_password", type="string", example="password"),
 *     @OA\Property(property="expired_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="deleted_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="order", ref="#/components/schemas/Order"),
 *     @OA\Property(property="services", type="array", @OA\Items(ref="#/components/schemas/Service")),
 * )
 */
class Server extends Model
{
    use HasFactory,HasUUID,HasUser;

    protected $fillable = [
        'user_id',
        'order_id',
        'website_url',
        'domain_name',
        'ip_address',
        'has_ssl',
        'has_backup',
        'backup_frequency',
        'has_application',
        'has_website',
        'source_code_updated_at',
        'application_updated_at',
        'database_password',
        'ssh_password',
        'expired_at',
    ];

    protected $casts = [
        'source_code_updated_at' => 'datetime',
        'application_updated_at' => 'datetime',
        'expired_at' => 'datetime',
    ];
    
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    
}
