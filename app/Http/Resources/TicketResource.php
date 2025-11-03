<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="TicketResource",
 *     description="Ticket resource",
 *     @OA\Xml(name="TicketResource"),
 *     @OA\Property(property="uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *     @OA\Property(property="subject", type="string", example="This is a ticket subject"),
 *     @OA\Property(property="description", type="string", example="This is a ticket description"),
 *     @OA\Property(property="department", type="string", example="contact"),
 *     @OA\Property(property="closed_by", type="string", example="John Doe"),
 *     @OA\Property(property="status", type="string", example="open"),
 *     @OA\Property(property="key", type="string", example="TICKET-1"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-09-01 00:00:00"),
 *     @OA\Property(property="priority", type="string", example="low"),
 *     @OA\Property(property="messages", type="array", nullable=true, @OA\Items(ref="#/components/schemas/MessageResource")),
 *     @OA\Property(property="last_message", nullable=true, ref="#/components/schemas/MessageResource"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 * )
 */
class TicketResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'uuid'          => $this->uuid,
            'subject'       => $this->subject,
            'description'   => $this->description,
            'department'    => $this->department->converted(),
            'closed_by'     => $this->closed_by,
            'status'        => $this->status->converted(),
            'ticket_number' => $this->ticket_number,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'priority'      => $this->priority->converted(),
            'messages'      => $this->whenLoaded('messages', function () {
                return MessageResource::collection($this->resource->messages);
            }),
            'last_message'  => $this->whenLoaded('lastMessage', function () {
                return MessageResource::make($this->resource->lastMessage);
            }),
            'user'          => $this->whenLoaded('user', function () {
                return UserResource::make($this->resource->user);
            }),
        ];
        
    }
}
