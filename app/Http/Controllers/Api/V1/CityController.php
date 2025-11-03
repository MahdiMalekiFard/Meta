<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityResource;
use App\Actions\City\StoreCityAction;
use App\Actions\City\DeleteCityAction;
use App\Actions\City\UpdateCityAction;
use App\Repositories\City\CityRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CityController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(City::class);
    }

    /**
         * @OA\Get(
         *      path="/city",
         *      operationId="getCitys",
         *      tags={"City"},
         *      summary="get citys list",
         *      description="Returns list of citys",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/CityResource")
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
    public function index(CityRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CityResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/city/{id}",
     *      operationId="getCityById",
     *      tags={"City"},
     *      summary="Get city information",
     *      description="Returns city data",
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CityResource")
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
    public function show(City $city): JsonResponse
    {
        return Response::data(
            CityResource::make($city),
        );
    }

    /**
     * @OA\Post(
     *      path="/city",
     *      operationId="storeCity",
     *      tags={"City"},
     *      summary="Store new city",
     *      description="Returns new city data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCityRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CityResource")
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
    public function store(StoreCityRequest $request): JsonResponse
    {
        $model = StoreCityAction::run($request->validated());
        return Response::data(
            CityResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('city.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/city/{id}",
     *      operationId="updateCity",
     *      tags={"City"},
     *      summary="Update existing city",
     *      description="Returns updated city data",
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCityRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CityResource")
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
     *          description="City Not Found"
     *      )
     * )
     */
    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $data = UpdateCityAction::run($city, $request->all());
        return Response::data(
            CityResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('city.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/city/{id}",
     *      operationId="deleteCity",
     *      tags={"City"},
     *      summary="Delete existing city",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
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
    public function destroy(City $city): JsonResponse
    {
        DeleteCityAction::run($city);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('city.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
