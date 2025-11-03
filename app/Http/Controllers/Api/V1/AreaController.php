<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Area;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Resources\AreaResource;
use App\Actions\Area\StoreAreaAction;
use App\Actions\Area\DeleteAreaAction;
use App\Actions\Area\UpdateAreaAction;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class AreaController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Area::class);
    }

    /**
         * @OA\Get(
         *      path="/area",
         *      operationId="getAreas",
         *      tags={"Area"},
         *      summary="get areas list",
         *      description="Returns list of areas",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/AreaResource")
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
    public function index(AreaRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            AreaResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/area/{id}",
     *      operationId="getAreaById",
     *      tags={"Area"},
     *      summary="Get area information",
     *      description="Returns area data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Area id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AreaResource")
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
    public function show(Area $area): JsonResponse
    {
        return Response::data(
            AreaResource::make($area),
        );
    }

    /**
     * @OA\Post(
     *      path="/area",
     *      operationId="storeArea",
     *      tags={"Area"},
     *      summary="Store new area",
     *      description="Returns new area data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreAreaRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AreaResource")
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
    public function store(StoreAreaRequest $request): JsonResponse
    {
        $model = StoreAreaAction::run($request->validated());
        return Response::data(
            AreaResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('area.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/area/{id}",
     *      operationId="updateArea",
     *      tags={"Area"},
     *      summary="Update existing area",
     *      description="Returns updated area data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Area id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateAreaRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AreaResource")
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
     *          description="Area Not Found"
     *      )
     * )
     */
    public function update(UpdateAreaRequest $request, Area $area): JsonResponse
    {
        $data = UpdateAreaAction::run($area, $request->all());
        return Response::data(
            AreaResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('area.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/area/{id}",
     *      operationId="deleteArea",
     *      tags={"Area"},
     *      summary="Delete existing area",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Area id",
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
    public function destroy(Area $area): JsonResponse
    {
        DeleteAreaAction::run($area);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('area.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
