<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Province;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProvinceRequest;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Resources\ProvinceResource;
use App\Actions\Province\StoreProvinceAction;
use App\Actions\Province\DeleteProvinceAction;
use App\Actions\Province\UpdateProvinceAction;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ProvinceController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Province::class);
    }

    /**
         * @OA\Get(
         *      path="/province",
         *      operationId="getProvinces",
         *      tags={"Province"},
         *      summary="get provinces list",
         *      description="Returns list of provinces",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ProvinceResource")
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
    public function index(ProvinceRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ProvinceResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/province/{id}",
     *      operationId="getProvinceById",
     *      tags={"Province"},
     *      summary="Get province information",
     *      description="Returns province data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProvinceResource")
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
    public function show(Province $province): JsonResponse
    {
        return Response::data(
            ProvinceResource::make($province),
        );
    }

    /**
     * @OA\Post(
     *      path="/province",
     *      operationId="storeProvince",
     *      tags={"Province"},
     *      summary="Store new province",
     *      description="Returns new province data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProvinceRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProvinceResource")
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
    public function store(StoreProvinceRequest $request): JsonResponse
    {
        $model = StoreProvinceAction::run($request->validated());
        return Response::data(
            ProvinceResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('province.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/province/{id}",
     *      operationId="updateProvince",
     *      tags={"Province"},
     *      summary="Update existing province",
     *      description="Returns updated province data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProvinceRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProvinceResource")
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
     *          description="Province Not Found"
     *      )
     * )
     */
    public function update(UpdateProvinceRequest $request, Province $province): JsonResponse
    {
        $data = UpdateProvinceAction::run($province, $request->all());
        return Response::data(
            ProvinceResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('province.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/province/{id}",
     *      operationId="deleteProvince",
     *      tags={"Province"},
     *      summary="Delete existing province",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
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
    public function destroy(Province $province): JsonResponse
    {
        DeleteProvinceAction::run($province);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('province.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
