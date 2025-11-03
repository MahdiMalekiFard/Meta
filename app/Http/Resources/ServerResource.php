<?php

namespace App\Http\Resources;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ServerResource",
 *     description="Server resource",
 *     @OA\Xml(name="ServerResource"),
 *     @OA\Property(property="id", type="integer", description="ID", example="1"),
 *     @OA\Property(property="uuid", type="string", description="UUID of the server", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="order", type="object", ref="#/components/schemas/OrderResource"),
 *     @OA\Property(property="website_url", type="string", description="Website URL", example="https://example.com"),
 *     @OA\Property(property="domain_name", type="string", description="Domain name", example="example.com"),
 *     @OA\Property(property="ip_address", type="string", description="IP address", example="192.168.1.1"),
 *     @OA\Property(property="has_ssl", type="boolean", description="Has SSL", example="true"),
 *     @OA\Property(property="has_backup", type="boolean", description="Has backup", example="true"),
 *     @OA\Property(property="backup_frequency", type="string", description="Backup frequency", example="daily"),
 *     @OA\Property(property="has_application", type="boolean", description="Has application", example="true"),
 *     @OA\Property(property="has_website", type="boolean", description="Has website", example="true"),
 *     @OA\Property(property="application_updated_at", type="string", description="Application updated at", example="2023-10-04 23:29:29"),
 *     @OA\Property(property="source_code_updated_at", type="string", description="Source code updated at", example="2023-10-04 23:29:29"),
 *     @OA\Property(property="is_active", type="boolean", description="Is active", example="true"),
 *     @OA\Property(property="expired_at", type="string", description="Expired at", example="2023-10-04 23:29:29"),
 *     @OA\Property(property="deleted_at", type="string", description="Deleted at", example="2023-10-04 23:29:29"),
 *     @OA\Property(property="created_at", type="string", description="Created at", example="2023-10-04 23:29:29"),
 *     @OA\Property(property="updated_at", type="string", description="Updated at", example="2023-10-04 23:29:29"),
 * )
 */
class ServerResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'uuid'                   => $this->uuid,
            'user'                   => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'order'                  => $this->whenLoaded('order', function () {
                return new OrderResource($this->order);
            }),
            'website_url'            => $this->website_url,
            'domain_name'            => $this->domain_name,
            'ip_address'             => $this->ip_address,
            'has_ssl'                => $this->has_ssl,
            'has_backup'             => $this->has_backup,
            'backup_frequency'       => $this->backup_frequency,
            'has_application'        => $this->has_application,
            'has_website'            => $this->has_website,
            'application_updated_at' => $this->application_updated_at,
            'source_code_updated_at' => $this->source_code_updated_at,
            'is_active'              => $this->is_active,
            'expired_at'             => $this->expired_at,
            'deleted_at'             => $this->deleted_at,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        
        ];
    }
}
