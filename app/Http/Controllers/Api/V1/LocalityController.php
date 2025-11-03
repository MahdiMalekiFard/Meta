<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Locality;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateLocalityRequest;
use App\Http\Requests\StoreLocalityRequest;
use App\Http\Resources\LocalityResource;
use App\Actions\Locality\StoreLocalityAction;
use App\Actions\Locality\DeleteLocalityAction;
use App\Actions\Locality\UpdateLocalityAction;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class LocalityController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Locality::class);
    }

    /**
         * @OA\Get(
         *      path="/locality",
         *      operationId="getLocalitys",
         *      tags={"Locality"},
         *      summary="get localitys list",
         *      description="Returns list of localitys",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/LocalityResource")
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
    public function index(LocalityRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            LocalityResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/locality/{id}",
     *      operationId="getLocalityById",
     *      tags={"Locality"},
     *      summary="Get locality information",
     *      description="Returns locality data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Locality id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LocalityResource")
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
    public function show(Locality $locality): JsonResponse
    {
        return Response::data(
            LocalityResource::make($locality),
        );
    }

    /**
     * @OA\Post(
     *      path="/locality",
     *      operationId="storeLocality",
     *      tags={"Locality"},
     *      summary="Store new locality",
     *      description="Returns new locality data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLocalityRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LocalityResource")
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
    public function store(StoreLocalityRequest $request): JsonResponse
    {
        $model = StoreLocalityAction::run($request->validated());
        return Response::data(
            LocalityResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/locality/{id}",
     *      operationId="updateLocality",
     *      tags={"Locality"},
     *      summary="Update existing locality",
     *      description="Returns updated locality data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Locality id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateLocalityRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LocalityResource")
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
     *          description="Locality Not Found"
     *      )
     * )
     */
    public function update(UpdateLocalityRequest $request, Locality $locality): JsonResponse
    {
        $data = UpdateLocalityAction::run($locality, $request->all());
        return Response::data(
            LocalityResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/locality/{id}",
     *      operationId="deleteLocality",
     *      tags={"Locality"},
     *      summary="Delete existing locality",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Locality id",
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
    public function destroy(Locality $locality): JsonResponse
    {
        DeleteLocalityAction::run($locality);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
