<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TicketDepartmentEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Actions\Ticket\StoreTicketAction;
use App\Actions\Ticket\DeleteTicketAction;
use App\Actions\Ticket\UpdateTicketAction;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class TicketController extends BaseApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['store']);
//        $this->authorizeResource(Ticket::class);
    }
    
    /**
     * @OA\Get(
     *      path="/ticket",
     *      operationId="getTickets",
     *      tags={"Ticket"},
     *      summary="get tickets list",
     *      description="Returns list of tickets",
     *      @OA\Parameter(
     *           name="page",
     *           description="page number",
     *           required=false,
     *           in="query",
     *           @OA\Schema(
     *               type="integer",
     *               example="1"
     *           )
     *       ),
     *      @OA\Parameter(
     *           name="page_limit",
     *           description="page limit",
     *           required=false,
     *           in="query",
     *           @OA\Schema(
     *               type="integer",
     *               example="15"
     *           )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TicketResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index(TicketRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            TicketResource::collection($repository->paginate())
        );
    }
    
    /**
     * @OA\Get(
     *      path="/ticket/{ticket}",
     *      operationId="getTicketById",
     *      tags={"Ticket"},
     *      summary="Get ticket information",
     *      description="Returns ticket data",
     *      @OA\Parameter(
     *          name="ticket",
     *          description="Ticket uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TicketResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(Ticket $ticket): JsonResponse
    {
        return Response::data(
            TicketResource::make($ticket),
        );
    }
    
    /**
     * @OA\Get(
     *      path="/ticket/data",
     *      operationId="getTicketData",
     *      tags={"Ticket"},
     *      summary="get ticket store needed data",
     *      description="Returns ticket store needed data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message",type="string",example="Ticket store successfully"),
     *              @OA\Property(property="data",type="object",
     *                  @OA\Property(property="departments",type="array", @OA\Items(type="object", @OA\Property(property="value", type="string", example="contact"), @OA\Property(property="label", type="string", example="Contact"))),
     *                  @OA\Property(property="priorities", type="array", @OA\Items(type="object", @OA\Property(property="value", type="string", example="low"), @OA\Property(property="label", type="string", example="Low"))),
     *                  @OA\Property(property="statuses", type="array", @OA\Items(type="object", @OA\Property(property="value", type="string", example="open"), @OA\Property(property="label", type="string", example="Open"))),
     *              ),
     *          ),
     *     ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function data(): JsonResponse
    {
        return Response::data(
            [
                'departments' => TicketDepartmentEnum::toArray(),
                'priorities'  => TicketPriorityEnum::toArray(),
                'statuses'    => TicketStatusEnum::toArray(),
            ],
        );
    }
    
    /**
     * @OA\Post(
     *      path="/ticket",
     *      operationId="storeTicket",
     *      tags={"Ticket"},
     *      summary="Store new ticket",
     *      description="Returns new ticket data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={},
     *                  @OA\Property(
     *                      property="media",
     *                      description="Ticket attachment",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                  allOf={@OA\Schema(ref="#/components/schemas/StoreTicketRequest")}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message",type="string",example="Ticket registered successfully"),
     *               @OA\Property(property="data", ref="#/components/schemas/TicketResource")
     *           )
     *       ),
     *
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreTicketRequest $request): JsonResponse
    {
        $model = StoreTicketAction::run($request->validated());
        return Response::data(
            TicketResource::make($model),
            trans('general.model_has_stored_successfully', ['model' => trans('ticket.model')]),
            Response::HTTP_CREATED
        );
    }
    
    /**
     * @OA\Put(
     *      path="/ticket/{ticket}",
     *      operationId="updateTicket",
     *      tags={"Ticket"},
     *      summary="Update existing ticket",
     *      description="Returns updated ticket data",
     *      @OA\Parameter(
     *          name="ticket",
     *          description="Ticket uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateTicketRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TicketResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Ticket Not Found"
     *      )
     * )
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $data = UpdateTicketAction::run($ticket, $request->all());
        return Response::data(
            TicketResource::make($data),
            trans('general.model_has_updated_successfully', ['model' => trans('ticket.model')]),
            Response::HTTP_ACCEPTED
        );
    }
    
    /**
     * @OA\Delete(
     *      path="/ticket/{ticket}",
     *      operationId="deleteTicket",
     *      tags={"Ticket"},
     *      summary="Delete existing ticket",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="ticket",
     *          description="Ticket uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        DeleteTicketAction::run($ticket);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully', ['model' => trans('ticket.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
