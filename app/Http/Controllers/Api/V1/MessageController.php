<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Actions\Message\StoreMessageAction;
use App\Actions\Message\DeleteMessageAction;
use App\Actions\Message\UpdateMessageAction;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class MessageController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Message::class);
    }

    /**
         * @OA\Get(
         *      path="/message/{ticket}",
         *      operationId="getMessages",
         *      tags={"Message"},
         *      summary="get messages list",
         *      description="Returns list of messages",
         *      @OA\Parameter(
         *           name="ticket",
         *           description="ticket uuid",
         *           required=true,
         *           in="path",
         *           @OA\Schema(
         *               type="string",
         *           )
         *       ),
         *      @OA\Parameter(
         *            name="page",
         *            description="page number",
         *            required=false,
         *            in="query",
         *            @OA\Schema(
         *                type="integer",
         *                example="1"
         *            )
         *        ),
         *       @OA\Parameter(
         *            name="page_limit",
         *            description="page limit",
         *            required=false,
         *            in="query",
         *            @OA\Schema(
         *                type="integer",
         *                example="15"
         *            )
         *        ),
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/MessageResource")
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
    public function index(Ticket $ticket,MessageRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            MessageResource::collection($repository->paginate(payload: ['ticket_id'=>$ticket->id]))
        );
    }

    /**
     * @OA\Get(
     *      path="/message/{id}",
     *      operationId="getMessageById",
     *      tags={"Message"},
     *      summary="Get message information",
     *      description="Returns message data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Message id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MessageResource")
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
    public function show(Message $message): JsonResponse
    {
        return Response::data(
            MessageResource::make($message),
        );
    }

    /**
     * @OA\Post(
     *      path="/message/{ticket}",
     *      operationId="storeMessage",
     *      tags={"Message"},
     *      summary="Store new message",
     *      description="Returns new message data",
     *      @OA\Parameter(
     *          name="ticket",
     *          description="ticket uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *          )
     *       ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMessageRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MessageResource")
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
    public function store(Ticket $ticket,StoreMessageRequest $request): JsonResponse
    {
        $model = StoreMessageAction::run($ticket,$request->validated());
        return Response::data(
            MessageResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('message.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/message/{id}",
     *      operationId="updateMessage",
     *      tags={"Message"},
     *      summary="Update existing message",
     *      description="Returns updated message data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Message id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateMessageRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MessageResource")
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
     *          description="Message Not Found"
     *      )
     * )
     */
    public function update(UpdateMessageRequest $request, Message $message): JsonResponse
    {
        $data = UpdateMessageAction::run($message, $request->all());
        return Response::data(
            MessageResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('message.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/message/{id}",
     *      operationId="deleteMessage",
     *      tags={"Message"},
     *      summary="Delete existing message",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Message id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
    public function destroy(Message $message): JsonResponse
    {
        DeleteMessageAction::run($message);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('message.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
