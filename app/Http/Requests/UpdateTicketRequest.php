<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Ticket request",
 *      description="Update Ticket request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateTicketRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the updated ticket",
     *      example=""
     * )
     *
     * @var string
     */
    public string $name;
    
    public function rules(): array
    {
        $rules = (new StoreTicketRequest())->rules();
        return array_merge($rules, [
        ]);
    }
}
