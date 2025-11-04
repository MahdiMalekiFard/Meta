<?php

namespace App\Http\Requests;

use App\Enums\TicketActionTypeEnum;
use App\Enums\TicketDepartmentEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Ticket request",
 *      description="Store Ticket request body data",
 *      type="object",
 *      required={"subject", "description", "department", "priority"},
 *      @OA\Xml(name="StoreTicketRequest"),
 *      @OA\Property(property="name", type="string",description="when user not authorised", example="John"),
 *      @OA\Property(property="family", type="string",description="when user not authorised", example="Doe"),
 *      @OA\Property(property="mobile", type="string",description="when user not authorised", example="09123456789"),
 *      @OA\Property(property="subject", type="string", example="This is a ticket subject"),
 *      @OA\Property(property="description", type="string", example="This is a ticket description"),
 *      @OA\Property(property="department", type="string",description="TicketDepartmentEnum::class", example="contact", enum={"contact", "sell"}),
 *      @OA\Property(property="status", type="string",description="TicketStatusEnum::class", example="open", enum={"open", "close"}),
 *      @OA\Property(property="priority", type="string",description="TicketPriorityEnum::class", example="low", enum={"low", "normal", "high"}),
 * )
 */
class StoreTicketRequest extends FormRequest
{
    
    public function rules(): array
    {
        $rules = [
            'media'       => 'sometimes|max:2048',
            'subject'     => 'nullable|max:255',
            'description' => 'required',
            'department'  => ['required', 'string', Rule::in(TicketDepartmentEnum::values())],
            'status'      => ['nullable', 'string', Rule::in(TicketStatusEnum::values())],
            'priority'    => ['required', 'string', Rule::in(TicketPriorityEnum::values())],
            'action_type' => ['required', 'string', Rule::in(TicketActionTypeEnum::values())],
        ];
        
        if (!auth('sanctum')->check()) {
            $rules['complete_name'] = 'required|string|max:255';
            $rules['mobile'] = 'required|string|max:255|regex:/^09[0-9]{9}$/';
        }
        
        return $rules;
    }
    
    public function attributes(): array
    {
        return [
            'subject'       => __('ticket.subject'),
            'action_type'   => __('ticket.action_type'),
            'complete_name' => __('ticket.complete_name'),
        ];
    }
}
