<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Server;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateServerRequest;
use App\Http\Requests\StoreServerRequest;
use App\Http\Resources\ServerResource;
use App\Actions\Server\StoreServerAction;
use App\Actions\Server\DeleteServerAction;
use App\Actions\Server\UpdateServerAction;
use App\Repositories\Server\ServerRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ServerController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Server::class);
    }

    /**
         * @OA\Get(
         *      path="/server",
         *      operationId="getServers",
         *      tags={"Server"},
         *      summary="get servers list",
         *      description="Returns list of servers",
         *      @OA\Response(
         *            response=200,
         *            description="Successful operation",
         *            @OA\JsonContent(
         *                type="object",
         *                @OA\Property(property="message",type="string",example=""),
         *                @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ServerResource")),
         *            ),
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
    public function index(ServerRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ServerResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/server/{server}",
     *      operationId="getServerById",
     *      tags={"Server"},
     *      summary="Get server information",
     *      description="Returns server data",
     *      @OA\Parameter(
     *          name="server",
     *          description="Server uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message",type="string",example=""),
     *               @OA\Property(property="data",type="object",ref="#/components/schemas/ServerResource"),
     *           ),
     *      ),
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
    public function show(Server $server): JsonResponse
    {
        return Response::data(
            ServerResource::make($server),
        );
    }

    /**
     * @OA\Post(
     *      path="/server",
     *      operationId="storeServer",
     *      tags={"Server"},
     *      summary="Store new server",
     *      description="Returns new server data",
     *      @OA\Response(
     *            response=201,
     *            description="Successful operation",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(property="message",type="string",example="Successful operation"),
     *                @OA\Property(property="data",type="object",ref="#/components/schemas/ServerResource"),
     *            ),
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
    public function store(StoreServerRequest $request): JsonResponse
    {
        $model = StoreServerAction::run($request->validated());
        return Response::data(
            ServerResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('server.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/server/{server}",
     *      operationId="updateServer",
     *      tags={"Server"},
     *      summary="Update existing server",
     *      description="Returns updated server data",
     *      @OA\Parameter(
     *          name="server",
     *          description="Server uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateServerRequest")
     *      ),
     *      @OA\Response(
     *             response=202,
     *             description="Successful operation",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="message",type="string",example="Successful operation"),
     *                 @OA\Property(property="data",type="object",ref="#/components/schemas/ServerResource"),
     *             ),
     *        ),
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
     *          description="Server Not Found"
     *      )
     * )
     */
    public function update(UpdateServerRequest $request, Server $server): JsonResponse
    {
        $data = UpdateServerAction::run($server, $request->all());
        return Response::data(
            ServerResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('server.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/server/{server}",
     *      operationId="deleteServer",
     *      tags={"Server"},
     *      summary="Delete existing server",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="server",
     *          description="Server uuid",
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
    public function destroy(Server $server): JsonResponse
    {
        DeleteServerAction::run($server);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('server.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
